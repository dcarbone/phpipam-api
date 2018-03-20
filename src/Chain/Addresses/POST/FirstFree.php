<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\POST;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree\InSubnet;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class FirstFree
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\POST
 */
class FirstFree extends AbstractPart implements UriPart {
    const PATH = 'first_free/';

    /**
     * @param int $subnetId
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree\InSubnet
     */
    public function InSubnet(int $subnetId): InSubnet {
        return $this->newPart(InSubnet::class, ['subnetId' => $subnetId]);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}