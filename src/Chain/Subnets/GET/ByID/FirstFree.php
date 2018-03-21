<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class FirstFree
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class FirstFree extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'first_free/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstFreeResponse|null
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
        return FirstFreeResponse::fromPSR7Response($resp, $this->logger);
    }
}