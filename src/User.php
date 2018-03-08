<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\User\DELETE;
use MyENA\PHPIPAMAPI\User\GET;
use MyENA\PHPIPAMAPI\User\PATCH;
use MyENA\PHPIPAMAPI\User\POST;

/**
 * Class User
 * @package MyENA\PHPIPAMAPI
 */
class User {
    const PATH = 'user/';

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
     * @return \MyENA\PHPIPAMAPI\User\GET
     */
    public function GET(): GET {
        return new GET($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\PATCH
     */
    public function PATCH(): PATCH {
        return new PATCH($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\DELETE
     */
    public function DELETE(): DELETE {
        return new DELETE($this->client, $this);
    }
}