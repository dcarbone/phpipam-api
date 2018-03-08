<?php namespace MyENA\PHPIPAMAPI\Chain\User;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\UserController;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\MethodPart;
use MyENA\PHPIPAMAPI\Request;

/**
 * Class POST
 * @package MyENA\PHPIPAMAPI\Request\User
 */
class POST extends AbstractPart implements MethodPart, ExecutablePart {
    const METHOD = 'POST';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * Perform user login with configured username and password
     *
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\User\POSTResponse
     * @type \MyENA\PHPIPAMAPI\Error|null
     * )
     */
    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }

        return POSTResponse::fromPSR7Response($resp);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Request
     */
    public function buildRequest(): Request {
        return new Request(
            $this->findMethod(),
            UserController::PATH,
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
    }
}