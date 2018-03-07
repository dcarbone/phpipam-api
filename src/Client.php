<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\Config\ConfigProvider;
use ENA\PHPIPAMAPI\Request\Addresses;
use ENA\PHPIPAMAPI\Request\User;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as PSR7Request;
use GuzzleHttp\Psr7\Uri as PSR7Uri;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
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
    private $sid;

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
     * @return \ENA\PHPIPAMAPI\Request\Addresses
     */
    public function Addresses(): Addresses {
        return new Addresses($this);
    }

    /**
     * @return \ENA\PHPIPAMAPI\Request\User
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
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function do(Request $request): ResponseInterface {
        $req = $this->compilePSR7($request);
        if (!$this->silent) {
            $this->logger->debug("Executing {$req->getUri()}");
        }
        $resp = $this->config->getClient()->send($req, self::$requestOptions);
        if (!$this->silent) {
            $this->logger->debug("Query returned {$resp->getStatusCode()}: {$resp->getReasonPhrase()}");
        }
        return $resp;
    }

    /**
     * Execute request where all response codes other than the one provided are considered erroneous.
     *
     * @param int $code
     * @param \ENA\PHPIPAMAPI\Request $request
     * @return array
     */
    public function require(int $code, Request $request): array {
        try {
            $resp = $this->do($request);
        } catch (GuzzleException $e) {
            return [null, Error::fromException($e)];
        }
        if ($resp->getStatusCode() == $code) {
            return [$resp, null];
        }
        return [$resp, Error::fromResponse($resp)];
    }

    /**
     * @return string
     */
    private function serviceAddress(): string {
        if (!isset($this->serviceAddress)) {
            $this->serviceAddress = sprintf(
                '%s://%s%s/api/%s',
                $this->config->useHTTPS() ? 'https' : 'http',
                $this->config->getHost(),
                (0 === ($port = $this->config->getPort()) ? '' : ":{$port}"),
                $this->config->getAppID()
            );
        }
        return $this->serviceAddress;
    }

    private function sessionID(): string {
        if (!isset($this->sid)) {
            $resp = $this->User()->POST()->execute();
        }
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
        return new PSR7Request($r->method(), $uri, $r->headers(), $r->body());
    }
}