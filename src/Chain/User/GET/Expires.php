<?php namespace MyENA\PHPIPAMAPI\Chain\User\GET;

use MyENA\PHPIPAMAPI\Part\AbstractExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Expires
 * @package MyENA\PHPIPAMAPI\Chain\User\GET
 */
class Expires extends AbstractExecutablePart implements UriPart {
    const PATH = 'expires/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\User\GET\ExpiresResponse|null
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
        return ExpiresResponse::fromPSR7Response($resp);
    }
}