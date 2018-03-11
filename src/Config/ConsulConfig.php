<?php namespace MyENA\PHPIPAMAPI\Config;

use DCarbone\PHPConsulAPI\Consul;
use DCarbone\PHPConsulAPI\Health\ServiceEntry;
use DCarbone\PHPConsulAPI\QueryOptions;
use GuzzleHttp\ClientInterface;

/**
 * Class ConsulConfig
 * @package MyENA\PHPIPAMAPI\Config
 */
class ConsulConfig extends LocalConfig {

    /** @var string */
    protected $serviceName;
    /** @var string */
    protected $serviceTag;
    /** @var bool */
    protected $healthyOnly;
    /** @var \DCarbone\PHPConsulAPI\QueryOptions */
    protected $queryOptions;
    /** @var string */
    protected $usernameKey;
    /** @var string */
    protected $passwordKey;
    /** @var string */
    protected $appIDKey;
    /** @var string */
    protected $appCodeKey;

    /** @var \DCarbone\PHPConsulAPI\Consul */
    protected $consul;

    /** @var \DCarbone\PHPConsulAPI\Health\ServiceEntry */
    private $service;

    /**
     * ConsulConfig constructor.
     * @param array $config
     * @param \GuzzleHttp\ClientInterface|null $client
     * @param \DCarbone\PHPConsulAPI\Consul|null $consul
     */
    public function __construct(array $config, ?ClientInterface $client = null, ?Consul $consul = null) {
        $this->processConfig($config);
        $this->consul = $consul;
        $this->client = $client;
        $this->validate();
    }

    /**
     * Returns host, preferring configured and will otherwise attempt to fetch service from Consul Health API
     *
     * @return string
     */
    public function getHost(): string {
        if ('' === $this->host) {
            $this->parseService();
        }
        return $this->host;
    }

    /**
     * Returns port, preferring configured and will otherwise attempt to fetch service from Consul Health API
     *
     * @return int
     */
    public function getPort(): int {
        if (0 === $this->port) {
            $this->parseService();
        }
        return $this->port;
    }

    /**
     * Returns user username, preferring configured and will otherwise attempt to fetch usernamekey from Consul
     *
     * @return string
     */
    public function getUsername(): string {
        if ('' === $this->username) {
            $this->username = $this->getKeyValue($this->getUsernameKey());
        }
        return $this->username;
    }

    /**
     * Returns user password, preferring configured and will otherwise attempt to fetch passwordkey from Consul
     *
     * @return string
     */
    public function getPassword(): string {
        if ('' === $this->password) {
            $this->password = $this->getKeyValue($this->getPasswordKey());
        }
        return $this->password;
    }

    /**
     * Returns api app id, preferring configured and will otherwise attempt to fetch appidkey from Consul
     *
     * @return string
     */
    public function getAppID(): string {
        if ('' === $this->appID) {
            $this->appID = $this->getKeyValue($this->getAppIDKey());
        }
        return $this->appID;
    }

    /**
     * Returns api app key, preferring configured and will otherwise attempt to fetch appcodekey from Consul
     *
     * @return string
     */
    public function getAppCode(): string {
        if ('' === $this->appCode) {
            $this->appCode = $this->getKeyValue($this->getAppCodeKey());
        }
        return $this->appCode;
    }

    /**
     * @return string
     */
    public function getServiceName(): string {
        return $this->serviceName;
    }

    /**
     * @return string
     */
    public function getServiceTag(): string {
        return $this->serviceTag;
    }

    /**
     * @return bool
     */
    public function useHealthyOnly(): bool {
        return $this->healthyOnly;
    }

    /**
     * @return \DCarbone\PHPConsulAPI\QueryOptions|null
     */
    public function getQueryOptions(): ?QueryOptions {
        return $this->queryOptions;
    }

    /**
     * @return string
     */
    public function getUsernameKey(): string {
        return $this->usernameKey;
    }

    /**
     * @return string
     */
    public function getPasswordKey(): string {
        return $this->passwordKey;
    }

    /**
     * @return string
     */
    public function getAppIDKey(): string {
        return $this->appIDKey;
    }

    /**
     * @return string
     */
    public function getAppCodeKey(): string {
        return $this->appCodeKey;
    }

    /**
     * @return \DCarbone\PHPConsulAPI\Consul
     */
    protected function getConsul(): Consul {
        if (!isset($this->consul)) {
            $this->consul = new Consul();
        }
        return $this->consul;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getKeyValue(string $key): string {
        /** @var \DCarbone\PHPConsulAPI\KV\KVPair $kvp */
        /** @var \DCarbone\PHPConsulAPI\QueryMeta $qm */
        /** @var \DCarbone\PHPConsulAPI\Error $err */
        [$kvp, $qm, $err] = $this->getConsul()->KV->get($key);
        if (null !== $err) {
            throw new \RuntimeException(sprintf(
                'Error querying Consul for KV "%s": %s',
                $key,
                $err
            ));
        } else if (null === $kvp || '' === (string)$kvp->Value) {
            throw new \RuntimeException(sprintf('Key "%s" is empty', $key));
        }
        return $kvp->Value;
    }

    /**
     * @return \DCarbone\PHPConsulAPI\Health\ServiceEntry
     */
    protected function getService(): ServiceEntry {
        if (!isset($this->service)) {
            /** @var \DCarbone\PHPConsulAPI\Health\ServiceEntry[] $svcs */
            /** @var \DCarbone\PHPConsulAPI\QueryMeta $qm */
            /** @var \DCarbone\PHPConsulAPI\Error $err */
            [$svcs, $qm, $err] = $this
                ->getConsul()
                ->Health
                ->service($this->serviceName, $this->serviceTag, $this->healthyOnly, $this->queryOptions);
            if (null !== $err) {
                throw new \RuntimeException(sprintf(
                    'Error querying Consul for %s service with name "%s" and tag "%s": %s',
                    $this->useHealthyOnly() ? 'healthy' : 'any',
                    $this->getServiceName(),
                    $this->getServiceTag(),
                    $err
                ));
            }
            if (0 === ($cnt = count($svcs))) {
                throw new \RuntimeException(sprintf(
                    'Unable to find %s service with name "%s" and tag "%s" found in Consul',
                    $this->useHealthyOnly() ? 'healthy' : 'any',
                    $this->getServiceName(),
                    $this->getServiceTag()
                ));
            }
            $this->service = reset($svcs);
        }
        return $this->service;
    }

    /**
     * Will attempt to fetch service from Consul and localize address and port values from service definition
     */
    protected function parseService(): void {
        $service = $this->getService();
        $this->host = $service->Service->Address;
        $this->port = $service->Service->Port;
    }

    /**
     * @param array $config
     */
    protected function processConfig(array $config): void {
        parent::processConfig($config);
        $this->serviceName = trim((string)$config['servicename'] ?? '');
        $this->serviceTag = trim((string)$config['servicetag'] ?? '');
        $this->healthyOnly = (bool)($config['healthyonly'] ?? true);
        if (isset($config['queryoptions'])) {
            if (is_array($config['queryoptions'])) {
                $this->queryOptions = new QueryOptions($config['queryoptions']);
            } else {
                $this->queryOptions = $config['queryoptions'];
            }
        } else {
            $this->queryOptions = null;
        }
        $this->usernameKey = trim((string)$config['usernamekey'] ?? '');
        $this->passwordKey = trim((string)$config['passwordkey'] ?? '');
        $this->appIDKey = trim((string)$config['appidkey'] ?? '');
        $this->appCodeKey = trim((string)$config['appcodekey'] ?? '');
    }

    /**
     * Perform some super simple post-construct sanity checking...
     */
    protected function validate(): void {
        if ('' === $this->serviceName && '' === $this->host && 0 === $this->port) {
            throw new \RuntimeException('servicename must be defined when host and port are not');
        }
        if ('' !== $this->serviceName && ('' !== $this->host || 0 !== $this->port)) {
            throw new \DomainException('defined host and port will be overridden by value from configured Consul service');
        }
        if (null !== $this->queryOptions &&
            !(is_object($this->queryOptions) || $this->queryOptions instanceof QueryOptions)) {
            throw new \RuntimeException('queryoptions must be null, an array to construct a QueryOptions class with, or an instance of QueryOptions');
        }
        if ('' === $this->username && '' === $this->usernameKey) {
            throw new \RuntimeException('usernamekey must be defined when username is not');
        }
        if ('' !== $this->username && '' !== $this->usernameKey) {
            throw new \DomainException('usernamekey will not be used when username is defined');
        }
        if ('' === $this->password && '' === $this->passwordKey) {
            throw new \RuntimeException('passwordkey must be defined when password is not');
        }
        if ('' !== $this->password && '' !== $this->passwordKey) {
            throw new \DomainException('passwordkey will not be used when password is defined');
        }
        if ('' === $this->appID && '' === $this->appIDKey) {
            throw new \RuntimeException('appidkey must be defined when appid is not');
        }
        if ('' !== $this->appID && '' !== $this->appIDKey) {
            throw new \DomainException('appidkey will not be used when appid is defined');
        }
        if ('' === $this->appCode && '' === $this->appCodeKey) {
            throw new \RuntimeException('appcodekey must be defined when appcode is not');
        }
        if ('' !== $this->appCode && '' !== $this->appCodeKey) {
            throw new \DomainException('appcodekey will not be used when appcode is defined');
        }
    }
}