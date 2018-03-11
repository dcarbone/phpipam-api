<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\Part\BodyPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\HeaderPart;
use MyENA\PHPIPAMAPI\Part\MethodPart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UnauthenticatedPart;
use MyENA\PHPIPAMAPI\Part\UriPart;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * TODO: Improve efficiency of parameter handling
 *
 * Class AbstractPart
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractPart implements LoggerAwareInterface {

    use LoggerAwareTrait;

    /** @var \MyENA\PHPIPAMAPI\Client */
    protected $client;
    /** @var \MyENA\PHPIPAMAPI\AbstractPart[] */
    protected $parents;

    /**
     * AbstractPart constructor.
     * @param \MyENA\PHPIPAMAPI\Client         $client
     * @param \Psr\Log\LoggerInterface         $logger
     * @param \MyENA\PHPIPAMAPI\AbstractPart[] ...$parents
     */
    public function __construct(Client $client, LoggerInterface $logger, AbstractPart ...$parents) {
        $this->client = $client;
        $this->parents = $parents;
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->logger = $logger;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Request
     */
    public function buildRequest(): Request {
        if ($this instanceof ExecutablePart) {
            return new Request(
                $this->findMethod(),
                $this->buildUri(),
                $this->compileRequestHeaders(),
                $this->compileQueryParameters(),
                ($this instanceof BodyPart ? $this->getBody() : null),
                !($this instanceof UnauthenticatedPart)
            );
        } else {
            throw $this->createInvalidChainException('ExecutablePart');
        }
    }

    /**
     * @param \MyENA\PHPIPAMAPI\Part\ParamPart $part
     * @param array $defined
     */
    protected function parseParameters(ParamPart $part, array $defined = []): void {
        foreach ($part->getParameters() as $parameter) {
            $parameter->setValue($defined[$parameter->getName()] ?? null);
            if (!$parameter->isValid()) {
                throw new \InvalidArgumentException(sprintf(
                    'Parameter %s failed %s validator with value: %s',
                    $parameter->getName(),
                    $parameter->getLastFailedValidator()->name(),
                    !is_resource($parameter->getValue()) ? json_encode($parameter->getValue()) : 'resource'
                ));
            }
        }
    }

    /**
     * @param string $class
     * @param array $parameters
     * @return \MyENA\PHPIPAMAPI\AbstractPart
     */
    protected function newPart(string $class, array $parameters = []): AbstractPart {
        /** @var \MyENA\PHPIPAMAPI\AbstractPart $np */
        $p = $this->parents;
        $p[] = $this;
        $np = new $class($this->client, $this->logger, ...$p);
        if ($np instanceof ParamPart) {
            $np->parseParameters($np, $parameters);
        } else if (0 !== ($cnt = count($parameters))) {
            throw new \DomainException(sprintf(
                'Part %s does not have any parameters, yet %d were passed',
                get_class($np),
                $cnt
            ));
        }
        return $np;
    }

    /**
     * @return string
     */
    protected function findMethod(): string {
        if ($this instanceof MethodPart) {
            return $this->getRequestMethod();
        } else {
            foreach ($this->parents as $parent) {
                if ($parent instanceof MethodPart) {
                    return $parent->getRequestMethod();
                }
            }
            throw $this->createInvalidChainException('MethodPart');
        }
    }

    /**
     * @return string
     */
    protected function buildUri(): string {
        $routeParams = [];
        $uri = '';
        foreach ($this->parents as $parent) {
            if ($parent instanceof UriPart) {
                $uri = "{$uri}{$parent->getUriPart()}";
            }
            if ($parent instanceof ParamPart) {
                foreach ($parent->getParameters() as $parameter) {
                    if ($parameter->getLocation() === Parameter::IN_ROUTE) {
                        $routeParams[$parameter->getName()] = $parameter->getValue();
                    }
                }
            }
        }
        if ($this instanceof UriPart) {
            $uri = "{$uri}{$this->getUriPart()}";
        }
        if ('' === $uri) {
            throw $this->createInvalidChainException('UriPart');
        }
        if ($this instanceof ParamPart) {
            foreach ($this->getParameters() as $parameter) {
                if ($parameter->getLocation() === Parameter::IN_ROUTE) {
                    $routeParams[$parameter->getName()] = $parameter->getValue();
                }
            }
        }
        foreach ($routeParams as $name => $value) {
            $uri = str_replace("{{$name}}", $value, $uri);
        }
        return $uri;
    }

    /**
     * @return array
     */
    protected function compileQueryParameters(): array {
        $queryParams = [];
        if ($this instanceof ParamPart) {
            foreach ($this->getParameters() as $parameter) {
                if ($parameter->getLocation() === Parameter::IN_QUERY) {
                    $queryParams[$parameter->getName()] = $parameter->getValue();
                }
            }
        }
        foreach ($this->parents as $parent) {
            if ($parent instanceof ParamPart) {
                foreach ($parent->getParameters() as $parameter) {
                    if ($parameter->getLocation() === Parameter::IN_QUERY) {
                        $queryParams[$parameter->getName()] = $parameter->getValue();
                    }
                }
            }
        }
        return array_filter(
            $queryParams,
            function ($v) {
                return null !== $v;
            }
        );
    }

    /**
     * @return array
     */
    protected function compileRequestHeaders(): array {
        $headers = [];
        if ($this instanceof HeaderPart) {
            $headers = $this->getRequestHeaders();
        }
        foreach ($this->parents as $parent) {
            if ($parent instanceof HeaderPart) {
                foreach ($parent->getRequestHeaders() as $header => $value) {
                    if (!isset($headers[$header])) {
                        $headers[$header] = $value;
                    } else if (is_array($headers[$header])) {
                        if (is_array($value)) {
                            $headers[$header] = array_merge($headers[$header], $value);
                        } else {
                            $headers[$header][] = $value;
                        }
                    } else if (is_array($value)) {
                        $headers[$header] = array_merge([$headers[$header]], $value);
                    } else {
                        $headers[$header] = [$headers[$header], $value];
                    }
                }
            }
        }
        return $headers;
    }

    /**
     * @param string $missing
     * @return \DomainException
     */
    protected function createInvalidChainException(string $missing): \DomainException {
        $parts = [];
        foreach ($this->parents as $parent) {
            $parts[] = get_class($parent);
        }
        $parts[] = get_class($this);

        return new \DomainException(sprintf(
            'Request Chain has no %s: ["%s"]',
            $missing,
            implode('", "', $parts)
        ));
    }
}