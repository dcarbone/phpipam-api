<?php namespace MyENA\PHPIPAMAPI;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as PSR7Request;
use GuzzleHttp\Psr7\Uri as PSR7Uri;
use GuzzleHttp\RequestOptions;
use MyENA\PHPIPAMAPI\Error\ApiError;
use MyENA\PHPIPAMAPI\Error\TransportError;
use MyENA\PHPIPAMAPI\User\POSTResponseData;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Client
 * @package MyENA\PHPIPAMAPI
 */
class Client implements LoggerAwareInterface {
    use LoggerAwareTrait;

    /** @var \MyENA\PHPIPAMAPI\Config */
    private $config;

    /** @var string */
    private $serviceAddress;

    /** @var \MyENA\PHPIPAMAPI\User\POSTResponseData */
    private $clientSession;

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
     * @param \MyENA\PHPIPAMAPI\Config $config
     * @param \Psr\Log\LoggerInterface|null $logger
     */
    public function __construct(Config $config, LoggerInterface $logger = null) {
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->logger = $logger;
        $this->config = $config;
        $this->silent = $this->config->silent();
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Addresses
     */
    public function Addresses(): Addresses {
        return new Addresses($this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User
     */
    public function User(): User {
        return new User($this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Config
     */
    public function getConfig(): Config {
        return $this->config;
    }

    /**
     * Returns the current token of this client
     *
     * @return \MyENA\PHPIPAMAPI\User\POSTResponseData|null
     */
    public function getClientSession(): ?POSTResponseData {
        return $this->clientSession ?? null;
    }

    /**
     * @param \MyENA\PHPIPAMAPI\Request $request
     * @return array(
     * @type \Psr\Http\Message\ResponseInterface    Response, if we received one
     * @type \MyENA\PHPIPAMAPI\Error                  Error, if we saw one
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
        // if a logout call is seen, check if it impacts our local client session
        if (isset($this->clientSession) &&
            false === $request->authenticated() &&
            'DELETE' === $request->method() &&
            User::ROOT_PATH === $request->uri() &&
            isset(($headers = $request->headers())[PHPIPAM_TOKEN_HEADER]) &&
            $headers[PHPIPAM_TOKEN_HEADER] === $this->clientSession->getToken()) {
            if (!$this->silent) {
                $this->logger->info('Client token has been invalidated');
            }
            $this->clientSession = null;
        } // try to catch login calls that are using our client user information
        else if (!isset($this->clientSession) &&
            false === $request->authenticated() &&
            'POST' === $request->method() &&
            User::ROOT_PATH === $request->uri() &&
            isset(($headers = $request->headers())['Authorization']) &&
            $headers['Authorization'] ===
            sprintf(
                'Basic %s',
                base64_encode("{$this->getConfig()->getUsername()}:{$this->getConfig()->getPassword()}")
            )) {
            if (!$this->silent) {
                $this->logger->info('Client token has been created');
            }
            // TODO: Really do not like this...
            $decoded = json_decode($resp->getBody()->getContents());
            if (JSON_ERROR_NONE === json_last_error() &&
                is_object($decoded) &&
                isset($decoded->data) &&
                is_object($decoded->data) &&
                isset($decoded->data->token) &&
                isset($decoded->data->expires)) {
                $this->clientSession = new POSTResponseData([
                    'token'   => $decoded->data->token,
                    'expires' => $decoded->data->expires,
                ]);
            }
        }
        return [$resp, null];
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
     * @return \MyENA\PHPIPAMAPI\User\POSTResponseData
     */
    private function clientSession(): POSTResponseData {
        if (!isset($this->token)) {
            /** @var \MyENA\PHPIPAMAPI\User\POSTResponse $resp */
            /** @var \MyENA\PHPIPAMAPI\Error $err */
            [$resp, $err] = $this->User()->POST()->execute();
            if (null !== $err) {
                throw new \RuntimeException(sprintf(
                    'Unable to authenticate user %s: %s',
                    $this->config->getUsername(),
                    $err
                ));
            }
            $this->token = $resp->getData();
            if (!$this->silent) {
                $this->logger->info('Client token has been created');
            }
        }
        return $this->token;
    }

    /**
     * @param \MyENA\PHPIPAMAPI\Request $r
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
            $r->headers() + ($r->authenticated() ? [PHPIPAM_TOKEN_HEADER => $this->clientSession()->getToken()] : []),
            $r->body());
    }
}