<?php namespace ENA\PHPIPAMAPI\Requests\Address;

use ENA\PHPIPAMAPI\Requests\Address;

/**
 * Class POST
 * @package ENA\PHPIPAMAPI\Requests\Address
 */
class POST {
    /** @var \ENA\PHPIPAMAPI\Requests\Address */
    private $address;

    /**
     * POST constructor.
     * @param \ENA\PHPIPAMAPI\Requests\Address $address
     */
    public function __construct(Address $address) {
        $this->address = $address;
    }
}