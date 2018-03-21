<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\CIDR\BySubnet;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class CIDR
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class CIDR extends AbstractPart implements UriPart {
    const PATH = 'cidr/';

    /**
     * @param string $subnet
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\CIDR\BySubnet
     */
    public function BySubnet(string $subnet): BySubnet {
        return $this->newPart(BySubnet::class, ['subnet' => $subnet]);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}