<?php namespace ENA\PHPIPAMAPI\Request\Addresses;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request\Addresses;

/**
 * Class GET
 * @package ENA\PHPIPAMAPI\Request\Addresses
 */
class GET {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Request\Addresses */
    private $address;

    /**
     * GET constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Request\Addresses $address
     */
    public function __construct(Client $client, Addresses $address) {
        $this->client = $client;
        $this->address = $address;
    }

    /**
     * @param string $id
     * @return \ENA\PHPIPAMAPI\Request\Addresses\GET\ByID
     */
    public function byID(string $id) {
        return new GET\ByID($this->client, $this, $id);
    }
}