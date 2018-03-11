<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Sections;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class SectionsController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class SectionsController extends AbstractPart implements UriPart {
    const PATH = 'sections/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Sections\GET
     */
    public function GET(): Sections\GET {
        return $this->newPart(Sections\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Sections\POST
     */
    public function POST(): Sections\POST {
        return $this->newPart(Sections\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Sections\PATCH
     */
    public function PATCH(): Sections\PATCH {
        return $this->newPart(Sections\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Sections\DELETE
     */
    public function DELETE(): Sections\DELETE {
        return $this->newPart(Sections\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}