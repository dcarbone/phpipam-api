<?php namespace ENA\PHPIPAMAPI\Request;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request\User\POST;

class User {
    const ROOT_PATH = '/user';

    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /**
     * User constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @return \ENA\PHPIPAMAPI\Request\User\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }
}