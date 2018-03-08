<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\Addresses\GET;
use MyENA\PHPIPAMAPI\Addresses\POST;

/**
 * Class Addresses
 * @package MyENA\PHPIPAMAPI\Request
 */
class Addresses {
    const ROOT_PATH = 'addresses/';

    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;

    /**
     * Address constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Addresses\GET
     */
    public function GET(): GET {
        return new GET($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Addresses\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }
}