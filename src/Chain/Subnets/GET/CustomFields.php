<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class CustomFields
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class CustomFields extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'custom_fields/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        var_dump($resp);
        exit;
    }
}