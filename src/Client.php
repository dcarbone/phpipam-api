<?php namespace MyENA\PHPIPAMAPI;

use DCarbone\Go\Time;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as PSR7Request;
use GuzzleHttp\Psr7\Uri as PSR7Uri;
use GuzzleHttp\RequestOptions;
use MyENA\PHPIPAMAPI\Chain\AddressesController;
use MyENA\PHPIPAMAPI\Chain\CircuitsController;
use MyENA\PHPIPAMAPI\Chain\DevicesController;
use MyENA\PHPIPAMAPI\Chain\L2DomainsController;
use MyENA\PHPIPAMAPI\Chain\PrefixController;
use MyENA\PHPIPAMAPI\Chain\SectionsController;
use MyENA\PHPIPAMAPI\Chain\SubnetsController;
use MyENA\PHPIPAMAPI\Chain\ToolsController;
use MyENA\PHPIPAMAPI\Chain\UserController;
use MyENA\PHPIPAMAPI\Chain\VlansController;
use MyENA\PHPIPAMAPI\Chain\VrfsController;
use MyENA\PHPIPAMAPI\Error\ApiError;
use MyENA\PHPIPAMAPI\Error\TransportError;
use MyENA\PHPIPAMAPI\Models\UserSession;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
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

    /** @var \MyENA\PHPIPAMAPI\Models\UserSession */
    private $clientUserSession;

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

        // TODO: is this needed in conjunction with __destruct?
//        $t = $this;
//        register_shutdown_function(function() use ($t) {
//            if (isset($t->clientUserSession)) {
//                $t->User()->DELETE()->execute();
//            }
//        });
    }

    /**
     * On destruction of class, terminate session token
     */
    public function __destruct() {
        if (isset($this->clientUserSession)) {
            $this->User()->DELETE()->execute();
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\AddressesController
     */
    public function Addresses(): AddressesController {
        return new AddressesController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\CircuitsController
     */
    public function Circuits(): CircuitsController {
        return new CircuitsController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\DevicesController
     */
    public function Devices(): DevicesController {
        return new DevicesController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\L2DomainsController
     */
    public function L2Domains(): L2DomainsController {
        return new L2DomainsController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\PrefixController
     */
    public function Prefix(): PrefixController {
        return new PrefixController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\SectionsController
     */
    public function Sections(): SectionsController {
        return new SectionsController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\SubnetsController
     */
    public function Subnets(): SubnetsController {
        return new SubnetsController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\ToolsController
     */
    public function ToolsController(): ToolsController {
        return new ToolsController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\UserController
     */
    public function User(): UserController {
        return new UserController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\VlansController
     */
    public function Vlans(): VlansController {
        return new VlansController($this, $this->logger);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\VrfsController
     */
    public function Vrfs(): VrfsController {
        return new VrfsController($this, $this->logger);
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
     * @return \MyENA\PHPIPAMAPI\Models\UserSession|null
     */
    public function getClientUserSession(): ?UserSession {
        return $this->clientUserSession ?? null;
    }

    /**
     * @param \MyENA\PHPIPAMAPI\Request $request
     * @return array(
     * @type \Psr\Http\Message\ResponseInterface    Response, if we received one
     * @type \MyENA\PHPIPAMAPI\Error                Error, if we saw one
     * )
     */
    public function do(Request $request): array {
        $psrRequest = $this->compilePSR7($request);
        if (!$this->silent) {
            $this->logger->debug("Executing: {$psrRequest->getMethod()} {$psrRequest->getUri()}");
        }
        try {
            $resp = $this->config->getClient()->send($psrRequest, self::$requestOptions);
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
        if (200 > $code || $code >= 300) {
            return [$resp, new ApiError($code, $resp->getBody()->getContents())];
        }
        // if this request modifies user session information, try to prevent weirdness.
        if (UserController::PATH === $request->uri()) {
            $this->updateSession($psrRequest, $resp);
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
     * Will attempt return the current user session for this client, attempting to procure one first if not set
     *
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    private function clientUserSession(): ?UserSession {
        if (!isset($this->clientUserSession)) {
            /** @var \MyENA\PHPIPAMAPI\Chain\User\POSTResponse $resp */
            /** @var \MyENA\PHPIPAMAPI\Error $err */
            [$resp, $err] = $this->User()->POST()->execute();
            if (null !== $err) {
                throw new \RuntimeException(sprintf(
                    'Unable to authenticate user %s: %s',
                    $this->config->getUsername(),
                    $err
                ));
            }
            $this->clientUserSession = new UserSession($resp->getData()->getToken(), $resp->getData()->getExpires());
        }
        return $this->clientUserSession ?? null;
    }

    /**
     * There are probably many, many situations this will miss.
     *
     * @param \Psr\Http\Message\RequestInterface
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    private function updateSession(RequestInterface $request, ResponseInterface $response): void {
        $method = $request->getMethod();
        if ('DELETE' === $method) {
            if (isset($this->clientUserSession) &&
                $request->getHeaderLine(PHPIPAM_TOKEN_HEADER) === $this->clientUserSession->getToken()) {
                if (!$this->silent) {
                    $this->logger->info('Client token invalidated');
                }
                $this->clientUserSession = null;
            }
        } else if ('PATCH' === $method) {
            if (isset($this->clientUserSession) &&
                $request->getHeaderLine(PHPIPAM_TOKEN_HEADER) === $this->clientUserSession->getToken()) {
                $this->clientUserSession->refreshFromPSR7Response($response);
                if (!$this->silent) {
                    $this->logger->info('Client token has been refreshed');
                }
            }
        } else if ('POST' === $method) {
            if ($request->getHeaderLine('Authorization') === sprintf(
                    'Basic %s',
                    base64_encode("{$this->getConfig()->getUsername()}:{$this->getConfig()->getPassword()}")
                )) {
                if (isset($this->clientUserSession) && $this->clientUserSession->getExpiresTime()->After(Time::Now())) {
                    if (!$this->silent) {
                        $this->logger->warning(sprintf(
                            'Login call made using configured credentials despite existing session not expiring for another "%s", will attempt to cleanup existing session...',
                            $this->clientUserSession->getExpiresTime()->UnixNanoDuration()
                        ));
                    }
                    [$_, $err] = $this->User()->DELETE()->execute();
                    if (null !== $err) {
                        if (!$this->silent) {
                            $this->logger->warning(sprintf('Error cleaning up existing session: %s', $err));
                        }
                    }
                }
                if (!$this->silent) {
                    $this->logger->info('Client token created');
                }
                $this->clientUserSession = UserSession::fromPSR7Response($response);
            }
        }
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
            $uri = $uri->withQuery(implode('&', $params));
        }
        return new PSR7Request(
            $r->method(),
            $uri,
            $r->headers() +
            ($r->authenticated() ? [PHPIPAM_TOKEN_HEADER => $this->clientUserSession()->getToken()] : []),
            $r->body());
    }
}