<?php namespace MyENA\PHPIPAMAPI\User\GET;

use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Request;
use MyENA\PHPIPAMAPI\User;
use MyENA\PHPIPAMAPI\User\GET;

/**
 * Class Admins
 * @package MyENA\PHPIPAMAPI\User\GET
 */
class Admins {
    const PATH = 'admins/';

    /** @var \MyENA\PHPIPAMAPI\Client */
    private $client;
    /** @var \MyENA\PHPIPAMAPI\User\GET */
    private $get;

    /**
     * Admins constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\User\GET $get
     */
    public function __construct(Client $client, GET $get) {
        $this->client = $client;
        $this->get = $get;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\User\GET\AdminsResponse|null
     * @type \MyENA\PHPIPAMAPI\Error|null
     * )
     */
    public function execute() {
        $r = new Request(
            'get',
            User::PATH.self::PATH
        );
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($r);
        if (null !== $err) {
            return [null, $err];
        }

        return AdminsResponse::fromPSR7Response($resp);
    }
}