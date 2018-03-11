<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Tools;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ToolsController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class ToolsController extends AbstractPart implements UriPart {
    const PATH = 'tools/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Tools\GET
     */
    public function GET(): Tools\GET {
        return $this->newPart(Tools\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Tools\POST
     */
    public function POST(): Tools\POST {
        return $this->newPart(Tools\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Tools\PATCH
     */
    public function PATCH(): Tools\PATCH {
        return $this->newPart(Tools\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Tools\DELETE
     */
    public function DELETE(): Tools\DELETE {
        return $this->newPart(Tools\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}