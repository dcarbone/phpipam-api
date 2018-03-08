<?php namespace MyENA\PHPIPAMAPI\Addresses;

use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Addresses;

/**
 * Class GET
 * @package MyENA\PHPIPAMAPI\Request\Addresses
 */
class GET {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \MyENA\PHPIPAMAPI\Addresses */
    private $address;

    /**
     * GET constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\Addresses $address
     */
    public function __construct(Client $client, Addresses $address) {
        $this->client = $client;
        $this->address = $address;
    }

    /**
     * @param string $id
     * @return \MyENA\PHPIPAMAPI\Addresses\GET\ByID
     */
    public function byID(string $id) {
        return new GET\ByID($this->client, $this, $id);
    }
}