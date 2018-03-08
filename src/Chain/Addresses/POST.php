<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\Chain\AddressesController;
use MyENA\PHPIPAMAPI\Client;

/**
 * Class POST
 * @package MyENA\PHPIPAMAPI\Request\Addresses
 */
class POST {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \MyENA\PHPIPAMAPI\Chain\AddressesController */
    private $address;

    /**
     * POST constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\Chain\AddressesController $address
     */
    public function __construct(Client $client, AddressesController $address) {
        $this->client = $client;
        $this->address = $address;
    }
}