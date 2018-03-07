<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\Addresses\GET;
use ENA\PHPIPAMAPI\Addresses\POST;

/**
 * Class Addresses
 * @package ENA\PHPIPAMAPI\Request
 */
class Addresses {
    const ROOT_PATH = 'addresses/';

    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /**
     * Address constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @return \ENA\PHPIPAMAPI\Addresses\GET
     */
    public function GET(): GET {
        return new GET($this->client, $this);
    }

    /**
     * @return \ENA\PHPIPAMAPI\Addresses\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }
}