<?php namespace ENA\PHPIPAMAPI\Requests;

use ENA\PHPIPAMAPI\Requests\Address\GET;
use ENA\PHPIPAMAPI\Requests\Address\POST;

/**
 * Class Address
 * @package ENA\PHPIPAMAPI\Requests
 */
class Address implements Request {
    const ROOT_PATH = '/addresses';

    /**
     * @return \ENA\PHPIPAMAPI\Requests\Address\GET
     */
    public function GET(): GET {
        return new GET($this);
    }

    /**
     * @return \ENA\PHPIPAMAPI\Requests\Address\POST
     */
    public function POST(): POST {
        return new POST($this);
    }

    /**
     * @return string
     */
    public function path(): string {
        return self::ROOT_PATH;
    }

    /**
     * @return mixed|null
     */
    public function body() {
        return null;
    }
}