<?php namespace ENA\PHPIPAMAPI\Request\Addresses\GET\ByID;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request\Addresses\GET\ByID;

/**
 * Class Ping
 * @package ENA\PHPIPAMAPI\Request\Addresses\GET\ByID
 */
class Ping {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Request\Addresses\GET\ByID */
    private $byID;

    /**
     * Ping constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Request\Addresses\GET\ByID $byID
     */
    public function __construct(Client $client, ByID $byID) {
        $this->client = $client;
        $this->byID = $byID;
    }
}