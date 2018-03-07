<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\Config\ConfigProvider;
use ENA\PHPIPAMAPI\Error\ApiError;
use ENA\PHPIPAMAPI\Error\TransportError;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as PSR7Request;
use GuzzleHttp\Psr7\Uri as PSR7Uri;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Client
 * @package ENA\PHPIPAMAPI
 */
class Client implements LoggerAwareInterface {
    use LoggerAwareTrait;

    /** @var \ENA\PHPIPAMAPI\Config\ConfigProvider */
    private $config;

    /** @var string */
    private $serviceAddress;

    /** @var string */
    private $token;

    /** @var bool */
    private $silent;

    /** @var array */
    private static $requestOptions = [
        RequestOptions::HTTP_ERRORS     => false,
        RequestOptions::DECODE_CONTENT  => false,
        RequestOptions::ALLOW_REDIRECTS => true,
    ];

    /**
     * Client constructor.
     * @param \ENA\PHPIPAMAPI\Config\ConfigProvider $config
     * @param \Psr\Log\LoggerInterface|null $logger
     */
    public function __construct(ConfigProvider $config, LoggerInterface $logger = null) {
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->logger = $logger;
        $this->config = $config;
        $this->silent = $this->config->silent();
    }

    /**
     * @return \ENA\PHPIPAMAPI\Addresses
     */
    public function Addresses(): Addresses {
        return new Addresses($this);
    }

    /**
     * @return \ENA\PHPIPAMAPI\User
     */
    public function User(): User {
        return new User($this);
    }

    /**
     * @return \ENA\PHPIPAMAPI\Config\ConfigProvider
     */
    public function getConfig(): ConfigProvider {
        return $this->config;
    }

    /**
     * @param \ENA\PHPIPAMAPI\Request $request
     * @return array(
     * @type \ENA\PHPIPAMAPI\Response   Response, if we received one
     * @type \ENA\PHPIPAMAPI\Error      Error, if we saw one
     * )
     */
    public function do(Request $request): array {
        $req = $this->compilePSR7($request);
        if (!$this->silent) {
            $this->logger->debug("Executing {$req->getUri()}");
        }
        try {
            $resp = $this->config->getClient()->send($req, self::$requestOptions);
        } catch (GuzzleException $e) {
            if (!$this->silent) {
                $this->logger->error("Query returned {$e->getCode()}: {$e->getMessage()}");
            }
            // TODO: do something different here?
            return [null, new TransportError($e->getCode(), $e->getMessage())];
        } catch (\Exception $e) {
            if (!$this->silent) {
                $this->logger->error("Query returned {$e->getCode()}: {$e->getMessage()}");
            }
            return [null, new TransportError($e->getCode(), $e->getMessage())];
        }
        if (!$this->silent) {
            $this->logger->debug("Query returned {$resp->getStatusCode()}: {$resp->getReasonPhrase()}");
        }
        $code = $resp->getStatusCode();
        if (200 < $code || $code >= 300) {
            return [$resp, new ApiError($code, $resp->getBody()->getContents())];
        }
        return Response::fromPSR7Response($resp);
    }

    /**
     * @return string
     */
    private function serviceAddress(): string {
        if (!isset($this->serviceAddress)) {
            $this->serviceAddress = sprintf(
                '%s://%s%s/api/%s/',
                $this->config->useHTTPS() ? 'https' : 'http',
                $this->config->getHost(),
                (0 === ($port = $this->config->getPort()) ? '' : ":{$port}"),
                $this->config->getAppID()
            );
        }
        return $this->serviceAddress;
    }

    /**
     * @return string
     */
    private function token(): string {
        if (!isset($this->token)) {
            /** @var \ENA\PHPIPAMAPI\User\POSTResponse $resp */
            /** @var \ENA\PHPIPAMAPI\Error $err */
            [$resp, $err] = $this->User()->POST()->execute();
            if (null !== $err) {
                throw new \RuntimeException(sprintf(
                    'Unable to authenticate user %s: %s',
                    $this->config->getUsername(),
                    $err
                ));
            }
            $this->token = $resp->getData()->getToken();
        }
        return $this->token;
    }

    /**
     * @param \ENA\PHPIPAMAPI\Request $r
     * @return \Psr\Http\Message\RequestInterface
     */
    private function compilePSR7(Request $r): RequestInterface {
        $uri = new PSR7Uri("{$this->serviceAddress()}{$r->uri()}");
        if (0 < (count($r->parameters()))) {
            $params = [];
            foreach ($r->parameters() as $k => $v) {
                $params[] = "{$k}={$v}";
            }
            $uri->withQuery(implode('&', $params));
        }
        return new PSR7Request(
            $r->method(),
            $uri,
            $r->headers() + ($r->authenticated() ? ['phpipam-token' => $this->token()] : []),
            $r->body());
    }
}