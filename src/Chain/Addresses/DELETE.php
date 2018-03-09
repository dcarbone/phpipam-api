<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class DELETE
 * @package MyENA\PHPIPAMAPI\Chain\Addresses
 */
class DELETE extends AbstractPart implements MethodPart {
    const METHOD = 'DELETE';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }
}