<?php namespace MyENA\PHPIPAMAPI\Addresses;

use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Addresses;

/**
 * Class POST
 * @package MyENA\PHPIPAMAPI\Request\Addresses
 */
class POST {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \MyENA\PHPIPAMAPI\Addresses */
    private $address;

    /**
     * POST constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\Addresses $address
     */
    public function __construct(Client $client, Addresses $address) {
        $this->client = $client;
        $this->address = $address;
    }
}