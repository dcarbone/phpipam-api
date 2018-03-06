<?php namespace ENA\PHPIPAMAPI\Requests\Address\GET;

use ENA\PHPIPAMAPI\Requests\Address\GET;

/**
 * Class ByID
 * @package ENA\PHPIPAMAPI\Requests\Address\GET
 */
class ByID {
    /** @var \ENA\PHPIPAMAPI\Requests\Address\GET */
    private $get;

    /** @var string */
    private $id;

    /**
     * ByID constructor.
     * @param \ENA\PHPIPAMAPI\Requests\Address\GET $GET
     * @param string $id
     */
    public function __construct(GET $GET, string $id) {
        $this->get = $GET;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string {
        return $this->id;
    }
}