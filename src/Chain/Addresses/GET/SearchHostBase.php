<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostBase\ByHostBase;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class SearchHostBase
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class SearchHostBase extends AbstractPart implements UriPart {
    const PATH = 'search_hostbase/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @param string $hostBase
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostBase\ByHostBase
     */
    public function ByHostBase(string $hostBase): ByHostBase {
        return $this->newPart(ByHostBase::class, ['hostbase' => $hostBase]);
    }
}