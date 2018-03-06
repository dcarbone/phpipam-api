<?php namespace ENA\PHPIPAMAPI\Requests\Address;
use ENA\PHPIPAMAPI\Requests\Address;

/**
 * Class GET
 * @package ENA\PHPIPAMAPI\Requests\Address
 */
class GET {
    /** @var \ENA\PHPIPAMAPI\Requests\Address */
    private $address;

    /**
     * GET constructor.
     * @param \ENA\PHPIPAMAPI\Requests\Address $address
     */
    public function __construct(Address $address) {
        $this->address = $address;
    }

    public function byID(string $id) {

    }
}