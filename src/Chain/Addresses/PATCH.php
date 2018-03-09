<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class PATCH
 * @package MyENA\PHPIPAMAPI\Chain\Addresses
 */
class PATCH extends AbstractPart implements MethodPart {
    const METHOD = 'PATCH';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }
}