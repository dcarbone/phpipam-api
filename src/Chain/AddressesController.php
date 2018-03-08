<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET;
use MyENA\PHPIPAMAPI\Chain\Addresses\POST;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class AddressesController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class AddressesController extends AbstractPart implements UriPart {
    const PATH = 'addresses/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET
     */
    public function GET(): GET {
        return new GET($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}