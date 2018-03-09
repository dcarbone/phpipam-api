<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search\ByIPAddress;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Search
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class Search extends AbstractPart implements UriPart {
    const PATH = 'search/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @param string $ipAddress
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search\ByIPAddress
     */
    public function ByIPAddress(string $ipAddress): ByIPAddress {
        return $this->newPart(ByIPAddress::class, ['ip_address' => $ipAddress]);
    }
}