<?php namespace ENA\PHPIPAMAPI\Addresses\GET\ByID;

use ENA\PHPIPAMAPI\Addresses\GET\ByID;
use ENA\PHPIPAMAPI\Client;

/**
 * Class Ping
 * @package ENA\PHPIPAMAPI\Request\Addresses\GET\ByID
 */
class Ping {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Addresses\GET\ByID */
    private $byID;

    /**
     * Ping constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Addresses\GET\ByID $byID
     */
    public function __construct(Client $client, ByID $byID) {
        $this->client = $client;
        $this->byID = $byID;
    }
}