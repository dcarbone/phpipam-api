<?php namespace ENA\PHPIPAMAPI\Request\User;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request;
use ENA\PHPIPAMAPI\Request\User;

/**
 * Class POST
 * @package ENA\PHPIPAMAPI\Request\User
 */
class POST {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \ENA\PHPIPAMAPI\Request\User */
    private $user;

    /**
     * POST constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Request\User $user
     */
    public function __construct(Client $client, User $user) {
        $this->client = $client;
        $this->user = $user;
    }

    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \ENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->require(200, new Request(
            'post',
            User::ROOT_PATH,
            [
                'PHP_AUTH_USER' => $this->client->getConfig()->getUsername(),
                'PHP_AUTH_PW'   => $this->client->getConfig()->getPassword(),
            ]
        ));
        if (null !== $err) {
            return [null, $err];
        }
    }
}