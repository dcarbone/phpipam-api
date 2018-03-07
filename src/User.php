<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\User\POST;

class User {
    const ROOT_PATH = 'user/';

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
     * @return \ENA\PHPIPAMAPI\User\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }
}