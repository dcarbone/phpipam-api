<?php namespace MyENA\PHPIPAMAPI\User;

use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Request;
use MyENA\PHPIPAMAPI\User;

/**
 * Class POST
 * @package MyENA\PHPIPAMAPI\Request\User
 */
class POST {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \MyENA\PHPIPAMAPI\User */
    private $user;

    /**
     * POST constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\User $user
     */
    public function __construct(Client $client, User $user) {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * Perform user login with configured username and password
     *
     * @return array(
     * @type \MyENA\PHPIPAMAPI\User\POSTResponse
     * @type \MyENA\PHPIPAMAPI\Error|null
     * )
     */
    public function execute(): array {
        $r = new Request(
            'post',
            User::PATH,
            [
                'Authorization' => sprintf(
                    'Basic %s',
                    base64_encode("{$this->client->getConfig()->getUsername()}:{$this->client->getConfig()->getPassword()}")
                ),
            ],
            [],
            null,
            false
        );

        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($r);
        if (null !== $err) {
            return [null, $err];
        }

        return POSTResponse::fromPSR7Response($resp);
    }
}