<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree;
use MyENA\PHPIPAMAPI\Chain\Addresses\POST\InSubnet;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class POST
 * @package MyENA\PHPIPAMAPI\Request\Addresses
 */
class POST extends AbstractPart implements MethodPart {
    const METHOD = 'POST';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree
     */
    public function FirstFree(): FirstFree {
        return $this->newPart(FirstFree::class);
    }

    /**
     * @param string $ip
     * @param int $subnetId
     * @param null|string $mac
     * @param null|string $switch
     * @param null|string $state
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\POST\InSubnet
     */
    public function InSubnet(string $ip,
                             int $subnetId,
                             ?string $mac = null,
                             ?string $switch = null,
                             ?string $state = null): InSubnet {
        return $this->newPart(
            InSubnet::class,
            [
                'ip'       => $ip,
                'subnetId' => $subnetId,
                'mac'      => $mac,
                'switch'   => $switch,
                'state'    => $state,
            ]
        );
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }
}