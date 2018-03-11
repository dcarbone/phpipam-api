<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\User\DELETE;
use MyENA\PHPIPAMAPI\Chain\User\GET;
use MyENA\PHPIPAMAPI\Chain\User\PATCH;
use MyENA\PHPIPAMAPI\Chain\User\POST;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class UserController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class UserController extends AbstractPart implements UriPart {
    const PATH = 'user/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\GET
     */
    public function GET(): GET {
        return $this->newPart(GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\POST
     */
    public function POST(): POST {
        return $this->newPart(POST::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\PATCH
     */
    public function PATCH(): PATCH {
        return $this->newPart(PATCH::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\DELETE
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