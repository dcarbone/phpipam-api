<?php namespace ENA\PHPIPAMAPI\Addresses;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Addresses;

/**
 * Class GET
 * @package ENA\PHPIPAMAPI\Request\Addresses
 */
class GET {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Addresses */
    private $address;

    /**
     * GET constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Addresses $address
     */
    public function __construct(Client $client, Addresses $address) {
        $this->client = $client;
        $this->address = $address;
    }

    /**
     * @param string $id
     * @return \ENA\PHPIPAMAPI\Addresses\GET\ByID
     */
    public function byID(string $id) {
        return new GET\ByID($this->client, $this, $id);
    }
}