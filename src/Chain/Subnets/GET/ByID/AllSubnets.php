<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AllSubnets\WithMask;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class AllSubnets
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class AllSubnets extends AbstractPart implements UriPart {
    const PATH = 'all_subnets/';

    /**
     * @param int $mask
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AllSubnets\WithMask
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