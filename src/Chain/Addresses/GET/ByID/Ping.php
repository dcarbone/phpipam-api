<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Ping
 * @package MyENA\PHPIPAMAPI\Request\Addresses\GET\ByID
 */
class Ping extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'ping/';

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
        return PingResponse::fromPSR7Response($resp);
    }
}