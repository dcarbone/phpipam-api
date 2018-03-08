<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\User\DELETE;
use MyENA\PHPIPAMAPI\User\POST;

/**
 * Class User
 * @package MyENA\PHPIPAMAPI
 */
class User {
    const ROOT_PATH = 'user/';

    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;

    /**
     * User constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\DELETE
     */
    public function DELETE(): DELETE {
        return new DELETE($this->client, $this);
    }
}