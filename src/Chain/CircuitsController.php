<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Circuits;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class CircuitsController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class CircuitsController extends AbstractPart implements UriPart {
    const PATH = 'circuits/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Circuits\GET
     */
    public function GET(): Circuits\GET {
        return $this->newPart(Circuits\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Circuits\POST
     */
    public function POST(): Circuits\POST {
        return $this->newPart(Circuits\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Circuits\PATCH
     */
    public function PATCH(): Circuits\PATCH {
        return $this->newPart(Circuits\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Circuits\DELETE
     */
    public function DELETE(): Circuits\DELETE {
        return $this->newPart(Circuits\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}