<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class All
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class All extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'all/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @deprecated This could be a potentially HUGE response.  Be very sure this is what you actually want to do.
     *
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Subnets\GET\AllResponse|null
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
        return AllResponse::fromPSR7Response($resp, $this->logger);
    }
}