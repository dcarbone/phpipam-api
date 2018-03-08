<?php namespace MyENA\PHPIPAMAPI\Chain\User;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\User\GET\Admins;
use MyENA\PHPIPAMAPI\Chain\User\GET\All;
use MyENA\PHPIPAMAPI\Chain\User\GET\Expires;
use MyENA\PHPIPAMAPI\Chain\User\GET\TokenExpires;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class GET
 * @package MyENA\PHPIPAMAPI\Chain\User
 */
class GET extends AbstractPart implements MethodPart {
    const METHOD = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\GET\TokenExpires
     */
    public function TokenExpires(): TokenExpires {
        return $this->newPart(TokenExpires::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\GET\Expires
     */
    public function Expires(): Expires {
        return $this->newPart(Expires::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\GET\All
     */
    public function All(): All {
        return $this->newPart(All::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\GET\Admins
     */
    public function Admins(): Admins {
        return $this->newPart(Admins::class);
    }
}