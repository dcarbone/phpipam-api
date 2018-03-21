<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Usage
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class Usage extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'usage/';

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
        return UsageResponse::fromPSR7Response($resp, $this->logger);
    }
}