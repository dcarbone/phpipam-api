<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Addresses\ByIP;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Addresses
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class Addresses extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'addresses/';

    /**
     * @param string $ip
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Addresses\ByIP
     */
    public function ByIP(string $ip): ByIP {
        return $this->newPart(ByIP::class, ['ip' => $ip]);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AddressesResponse|null
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
        return AddressesResponse::fromPSR7Response($resp, $this->logger);
    }
}
