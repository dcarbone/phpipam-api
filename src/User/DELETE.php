<?php namespace MyENA\PHPIPAMAPI\User;

use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Error\ApiError;
use MyENA\PHPIPAMAPI\Request;
use MyENA\PHPIPAMAPI\User;

/**
 * Class DELETE
 * @package MyENA\PHPIPAMAPI\User
 */
class DELETE {
    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \MyENA\PHPIPAMAPI\User */
    private $user;

    /**
     * DELETE constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\User $user
     */
    public function __construct(Client $client, User $user) {
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * Perform user logout
     *
     * @return array
     */
    public function execute(): array {
        if (null === ($cs = $this->client->getClientSession())) {
            return [null, new ApiError(400, 'Client session is not open')];
        }
        $r = new Request(
            'delete',
            User::ROOT_PATH,
            [PHPIPAM_TOKEN_HEADER => $cs->getToken()],
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

        return DELETEResponse::fromPSR7Response($resp);
    }
}