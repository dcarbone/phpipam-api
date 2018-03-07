<?php namespace ENA\PHPIPAMAPI\Request;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request\Addresses\GET;
use ENA\PHPIPAMAPI\Request\Addresses\POST;

/**
 * Class Addresses
 * @package ENA\PHPIPAMAPI\Request
 */
class Addresses {
    const ROOT_PATH = '/addresses';

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
     * @return \ENA\PHPIPAMAPI\Request\Addresses\GET
     */
    public function GET(): GET {
        return new GET($this->client, $this);
    }

    /**
     * @return \ENA\PHPIPAMAPI\Request\Addresses\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }
}