<?php namespace ENA\PHPIPAMAPI\Requests\Address\GET\ByID;

use ENA\PHPIPAMAPI\Requests\Address\GET\ByID;

/**
 * Class Ping
 * @package ENA\PHPIPAMAPI\Requests\Address\GET\ByID
 */
class Ping {
    /** @var \ENA\PHPIPAMAPI\Requests\Address\GET\ByID */
    private $byID;

    /**
     * Ping constructor.
     * @param \ENA\PHPIPAMAPI\Requests\Address\GET\ByID $byID
     */
    public function __construct(ByID $byID) {
        $this->byID = $byID;
    }
}