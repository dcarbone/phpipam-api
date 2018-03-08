<?php namespace MyENA\PHPIPAMAPI\User;


use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\User;

/**
 * Class GET
 * @package MyENA\PHPIPAMAPI\User
 */
class GET {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \MyENA\PHPIPAMAPI\User */
    private $user;

    /**
     * GET constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\User $user
     */
    public function __construct(Client $client, User $user) {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\GET\TokenExpires
     */
    public function TokenExpires(): User\GET\TokenExpires {
        return new User\GET\TokenExpires($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\GET\Expires
     */
    public function Expires(): User\GET\Expires {
        return new User\GET\Expires($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\GET\All
     */
    public function All(): User\GET\All {
        return new User\GET\All($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\GET\Admins
     */
    public function Admins(): User\GET\Admins {
        return new User\GET\Admins($this->client, $this);
    }
}