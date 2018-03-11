<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\L2Domains;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class L2DomainsController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class L2DomainsController extends AbstractPart implements UriPart {
    const PATH = 'l2domains/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\L2Domains\GET
     */
    public function GET(): L2Domains\GET {
        return $this->newPart(L2Domains\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\L2Domains\POST
     */
    public function POST(): L2Domains\POST {
        return $this->newPart(L2Domains\POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\L2Domains\PATCH
     */
    public function PATCH(): L2Domains\PATCH {
        return $this->newPart(L2Domains\PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\L2Domains\DELETE
     */
    public function DELETE(): L2Domains\DELETE {
        return $this->newPart(L2Domains\DELETE::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}