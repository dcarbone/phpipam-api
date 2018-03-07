<?php namespace ENA\PHPIPAMAPI\Request\Addresses;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request\Addresses;

/**
 * Class POST
 * @package ENA\PHPIPAMAPI\Request\Addresses
 */
class POST {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Request\Addresses */
    private $address;

    /**
     * POST constructor.
     * @param \ENA\PHPIPAMAPI\Request\Addresses $address
     */
    public function __construct(Client $client, Addresses $address) {
        $this->client = $client;
        $this->address = $address;
    }
}