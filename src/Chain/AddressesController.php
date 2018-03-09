<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\DELETE;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET;
use MyENA\PHPIPAMAPI\Chain\Addresses\PATCH;
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
        return $this->newPart(GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\POST
     */
    public function POST(): POST {
        return $this->newPart(POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\PATCH
     */
    public function PATCH(): PATCH {
        return $this->newPart(PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\DELETE
     */
    public function DELETE(): DELETE {
        return $this->newPart(DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}