<?php namespace ENA\PHPIPAMAPI\Config;

/**
 * Interface ConfigProvider
 * @package ENA\PHPIPAMAPI\Config
 */
interface ConfigProvider {
    /**
     * @return string
     */
    public function getHost(): string;

    /**
     * @return int
     */
    public function getPort(): int;

    /**
     * @return bool
     */
    public function useHTTPS(): bool;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return string
     */
    public function getAppID(): string;

    /**
     * @return string
     */
    public function getAppKey(): string;
}