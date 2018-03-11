<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Devices;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class DevicesController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class DevicesController extends AbstractPart implements UriPart {
    const PATH = 'devices/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Devices\GET
     */
    public function GET(): Devices\GET {
        return $this->newPart(Devices\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Devices\POST
     */
    public function POST(): Devices\POST {
        return $this->newPart(Devices\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Devices\PATCH
     */
    public function PATCH(): Devices\PATCH {
        return $this->newPart(Devices\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Devices\DELETE
     */
    public function DELETE(): Devices\DELETE {
        return $this->newPart(Devices\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}