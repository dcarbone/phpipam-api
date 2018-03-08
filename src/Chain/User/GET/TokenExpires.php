<?php namespace MyENA\PHPIPAMAPI\Chain\User\GET;

use MyENA\PHPIPAMAPI\Part\AbstractExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class TokenExpires
 * @package MyENA\PHPIPAMAPI\Chain\User\GET
 */
class TokenExpires extends AbstractExecutablePart implements UriPart {
    const PATH = 'token_expires/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\User\GET\TokenExpiresResponse|null
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
        return TokenExpiresResponse::fromPSR7Response($resp);
    }
}