<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Subnets;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class SubnetsController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class SubnetsController extends AbstractPart implements UriPart {
    const PATH = 'subnets/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET
     */
    public function GET(): Subnets\GET {
        return $this->newPart(Subnets\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\POST
     */
    public function POST(): Subnets\POST {
        return $this->newPart(Subnets\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\PATCH
     */
    public function PATCH(): Subnets\PATCH {
        return $this->newPart(Subnets\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\DELETE
     */
    public function DELETE(): Subnets\DELETE {
        return $this->newPart(Subnets\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}