<?php namespace ENA\PHPIPAMAPI\Addresses;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Addresses;

/**
 * Class POST
 * @package ENA\PHPIPAMAPI\Request\Addresses
 */
class POST {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Addresses */
    private $address;

    /**
     * POST constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Addresses $address
     */
    public function __construct(Client $client, Addresses $address) {
        $this->client = $client;
        $this->address = $address;
    }
}