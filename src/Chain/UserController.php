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
        return new GET($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\POST
     */
    public function POST(): POST {
        return new POST($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\PATCH
     */
    public function PATCH(): PATCH {
        return new PATCH($this->client, $this);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\User\DELETE
     */
    public function DELETE(): DELETE {
        return new DELETE($this->client, $this);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}