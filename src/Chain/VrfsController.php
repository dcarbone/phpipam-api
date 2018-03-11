<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Vrfs;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class VrfsController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class VrfsController extends AbstractPart implements UriPart {
    const PATH = 'vrfs/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vrfs\GET
     */
    public function GET(): Vrfs\GET {
        return $this->newPart(Vrfs\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vrfs\POST
     */
    public function POST(): Vrfs\POST {
        return $this->newPart(Vrfs\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vrfs\PATCH
     */
    public function PATCH(): Vrfs\PATCH {
        return $this->newPart(Vrfs\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Vrfs\DELETE
     */
    public function DELETE(): Vrfs\DELETE {
        return $this->newPart(Vrfs\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}