<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByID;
use MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class DELETE
 * @package MyENA\PHPIPAMAPI\Chain\Addresses
 */
class DELETE extends AbstractPart implements MethodPart {
    const METHOD = 'DELETE';

    /**
     * @param int $id
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByID
     */
    public function ByID(int $id): ByID {
        return $this->newPart(ByID::class, ['id' => $id]);
    }

    /**
     * @param string $ip
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP
     */
    public function ByIP(string $ip): ByIP {
        return $this->newPart(ByIP::class, ['ip' => $ip]);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }
}