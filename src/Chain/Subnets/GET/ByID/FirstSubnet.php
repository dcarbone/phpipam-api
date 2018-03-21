<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstSubnet\WithMask;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class FirstSubnet
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class FirstSubnet extends AbstractPart implements UriPart {
    const PATH = 'first_subnet/';

    /**
     * @param int $mask
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstSubnet\WithMask
     */
    public function WithMask(int $mask): WithMask {
        return $this->newPart(WithMask::class, ['mask' => $mask]);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}