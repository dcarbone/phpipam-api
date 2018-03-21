<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class GET
 * @package MyENA\PHPIPAMAPI\Chain\Subnets
 */
class GET extends AbstractPart implements MethodPart {
    const METHOD = 'GET';

    /**
     * @deprecated TODO: THIS IS A POTENTIALLY HUGE RESPONSE!  Be absolutely certain you actually want to call this.
     *
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\All
     */
    public function All(): GET\All {
        return $this->newPart(GET\All::class);
    }

    /**
     * @param int $id
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
     */
    public function ByID(int $id): GET\ByID {
        return $this->newPart(GET\ByID::class, ['id' => $id]);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\CIDR
     */
    public function CIDR(): GET\CIDR {
        return $this->newPart(GET\CIDR::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\CustomFields
     */
    public function CustomFields(): GET\CustomFields {
        return $this->newPart(GET\CustomFields::class);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }
}