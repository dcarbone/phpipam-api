<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Vlans;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class VlansController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class VlansController extends AbstractPart implements UriPart {
    const PATH = 'vlans/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vlans\GET
     */
    public function GET(): Vlans\GET {
        return $this->newPart(Vlans\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vlans\POST
     */
    public function POST(): Vlans\POST {
        return $this->newPart(Vlans\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vlans\PATCH
     */
    public function PATCH(): Vlans\PATCH {
        return $this->newPart(Vlans\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vlans\DELETE
     */
    public function DELETE(): Vlans\DELETE {
        return $this->newPart(Vlans\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}