<?php namespace ENA\PHPIPAMAPI\Config;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class Config
 * @package ENA\PHPIPAMAPI\Config
 */
class Config implements ConfigProvider {
    /** @var string */
    protected $host;
    /** @var int */
    protected $port;
    /** @var bool */
    protected $https = true;
    /** @var string */
    protected $username;
    /** @var string */
    protected $password;
    /** @var string */
    protected $appID;
    /** @var string */
    protected $appKey;

    /** @var \GuzzleHttp\ClientInterface */
    protected $client;

    /**
     * Config constructor.
     * @param array $config
     * @param \GuzzleHttp\ClientInterface|null $client
     */
    public function __construct(array $config, ?ClientInterface $client = null) {
        $this->processConfig($config);
        $this->validate();
        $this->client = $client;
    }

    /**
     * Returns configured php-ipam service host
     *
     * @return string
     */
    public function getHost(): string {
        return $this->host;
    }

    /**
     * Returns configured php-ipam service host
     *
     * @return int
     */
    public function getPort(): int {
        return $this->port;
    }

    /**
     * Returns whether communication will happen over https or not
     *
     * @return bool
     */
    public function useHTTPS(): bool {
        return $this->https;
    }

    /**
     * Returns configured php-ipam user username
     *
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Returns configured php-ipam user password
     *
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Returns configured api app id
     *
     * @return string
     */
    public function getAppID(): string {
        return $this->appID;
    }

    /**
     * Returns configured api app key
     *
     * @return string
     */
    public function getAppKey(): string {
        return $this->appKey;
    }

    /**
     * Returns GuzzleHttp-compatible http client, optionally constructing a new one if one was not provided at construction
     *
     * @return \GuzzleHttp\ClientInterface
     */
    public function getClient(): ClientInterface {
        if (!isset($this->client)) {
            $this->client = new Client();
        }
        return $this->client;
    }

    /**
     * Takes provided config input and defines local vars, optionally setting empty or default values if fields are omitted.
     *
     * @param array $config
     */
    protected function processConfig(array $config): void {
        $this->host = trim((string)($config['host'] ?? ''));
        $this->port = (int)($config['port'] ?? '');
        $this->https = (bool)($config['https'] ?? true);
        $this->username = trim((string)($config['username'] ?? ''));
        $this->password = trim((string)($config['password'] ?? ''));
        $this->appID = trim((string)($config['appid'] ?? ''));
        $this->appKey = trim((string)($config['appkey'] ?? ''));
    }

    /**
     * Perform post-config processing validation
     */
    protected function validate(): void {
        if ('' === $this->host) {
            throw new \InvalidArgumentException('host cannot be empty');
        }
        if (0 > $this->port) {
            throw new \InvalidArgumentException('port must be > 0');
        }
        if ('' === $this->username) {
            throw new \InvalidArgumentException('username cannot be empty');
        }
        if ('' === $this->password) {
            throw new \InvalidArgumentException('password cannot be empty');
        }
        if ('' === $this->appID) {
            throw new \InvalidArgumentException('appid cannot be empty');
        }
        if ('' === $this->appKey) {
            throw new \InvalidArgumentException('appkey cannot be empty');
        }
    }
}