<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\Part\AbstractExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class FirstFree
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class FirstFree extends AbstractExecutablePart implements UriPart {
    const PATH = 'first_free/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\GET\FirstFreeResponse|null
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
        return FirstFreeResponse::fromPSR7Response($resp);
    }
}