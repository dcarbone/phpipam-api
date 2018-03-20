<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class CIDR
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class CIDR extends AbstractPart implements UriPart {
    const PATH = 'cidr/';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}