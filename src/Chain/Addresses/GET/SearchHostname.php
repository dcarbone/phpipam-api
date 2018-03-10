<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname\ByHostname;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class SearchHostname
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class SearchHostname extends AbstractPart implements UriPart {
    const PATH = 'search_hostname/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @param string $hostname
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname\ByHostname
     */
    public function ByHostname(string $hostname): ByHostname {
        return $this->newPart(ByHostname::class, ['hostname' => $hostname]);
    }
}