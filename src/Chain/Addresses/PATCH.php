<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\PATCH\ByID;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class PATCH
 * @package MyENA\PHPIPAMAPI\Chain\Addresses
 */
class PATCH extends AbstractPart implements MethodPart {
    const METHOD = 'PATCH';

    /**
     * @param int $id
     * @param null|string $mac
     * @param int|null $switch
     * @param int|null $state
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\PATCH\ByID
     */
    public function ByID(int $id, ?string $mac = null, ?int $switch = null, ?int $state = null): ByID {
        return $this->newPart(ByID::class, ['id' => $id, 'mac' => $mac, 'switch' => $switch, 'state' => $state]);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }
}