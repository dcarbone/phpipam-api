<?php namespace ENA\PHPIPAMAPI;
use ENA\PHPIPAMAPI\Config\ConfigProvider;

/**
 * Class Client
 * @package ENA\PHPIPAMAPI
 */
class Client {
    /** @var \ENA\PHPIPAMAPI\Config\ConfigProvider  */
    private $config;

    /**
     * Client constructor.
     * @param \ENA\PHPIPAMAPI\Config\ConfigProvider $config
     */
    public function __construct(ConfigProvider $config) {
        $this->config = $config;
    }
}