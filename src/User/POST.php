<?php namespace ENA\PHPIPAMAPI\User;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request;
use ENA\PHPIPAMAPI\User;

/**
 * Class POST
 * @package ENA\PHPIPAMAPI\Request\User
 */
class POST {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \ENA\PHPIPAMAPI\User */
    private $user;

    /**
     * POST constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\User $user
     */
    public function __construct(Client $client, User $user) {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * Perform user login with configured username and password
     *
     * @return array(
     * @type \ENA\PHPIPAMAPI\
     * )
     */
    public function execute(): array {
        $r = new Request(
            'post',
            User::ROOT_PATH,
            [
                'Authorization' => "{$this->client->getConfig()->getUsername()}:{$this->client->getConfig()->getPassword()}",
            ]
        );

        /** @var \ENA\PHPIPAMAPI\Response $resp */
        /** @var \ENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($r);
        if (null !== $err) {
            return [null, $err];
        }

        return [new POSTResponse($resp), null];
    }
}