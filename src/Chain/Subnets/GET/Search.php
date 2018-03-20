<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Search
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class Search extends AbstractPart implements UriPart {
    const PATH = 'search/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}