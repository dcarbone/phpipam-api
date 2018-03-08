<?php namespace MyENA\PHPIPAMAPI\User;

use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Request;
use MyENA\PHPIPAMAPI\User;

/**
 * Class PATCH
 * @package MyENA\PHPIPAMAPI\User
 */
class PATCH {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \MyENA\PHPIPAMAPI\User */
    private $user;

    /**
     * PATCH constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\User $user
     */
    public function __construct(Client $client, User $user) {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\User\PATCHResponse|null
     * @type \MyENA\PHPIPAMAPI\Error|null
     * )
     */
    public function execute(): array {
        $r = new Request(
            'patch',
            User::ROOT_PATH
        );
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($r);
        if (null !== $err) {
            return [null, $err];
        }
        return PATCHResponse::fromPSR7Response($resp);
    }
}