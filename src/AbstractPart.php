<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\Part\MethodPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class AbstractPart
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractPart {
    /** @var \MyENA\PHPIPAMAPI\Client */
    protected $client;
    /** @var \MyENA\PHPIPAMAPI\AbstractPart[] */
    protected $parents;

    /**
     * AbstractPart constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\AbstractPart[] ...$parents
     */
    public function __construct(Client $client, AbstractPart ...$parents) {
        $this->client = $client;
        $this->parents = $parents;
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
        if ($this instanceof UriPart) {
            $uri = $this->getUriPart();
        } else {
            $uri = '';
        }
        foreach ($this->parents as $parent) {
            if ($parent instanceof UriPart) {
                $uri = "{$parent->getUriPart()}{$uri}";
            }
        }
        if ('' === $uri) {
            throw $this->createInvalidChainException('UriPart');
        }
        return $uri;
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

    /**
     * @param array ...$args
     */
    protected function parseArgs(...$args): void {
        // implement as needed
    }

    /**
     * @param string $class
     * @param array $args
     * @return \MyENA\PHPIPAMAPI\AbstractPart
     */
    protected function newPart(string $class, ...$args): AbstractPart {
        /** @var \MyENA\PHPIPAMAPI\AbstractPart $np */
        $p = $this->parents;
        $p[] = $this;
        $np = new $class($this->client, ...$p);
        $np->parseArgs(...$args);
        return $np;
    }
}