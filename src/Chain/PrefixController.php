<?php namespace MyENA\PHPIPAMAPI\Chain;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Prefix;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class PrefixController
 * @package MyENA\PHPIPAMAPI\Chain
 */
class PrefixController extends AbstractPart implements UriPart {
    const PATH = 'prefix/';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Prefix\GET
     */
    public function GET(): Prefix\GET {
        return $this->newPart(Prefix\GET::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Prefix\POST
     */
    public function POST(): Prefix\POST {
        return $this->newPart(Prefix\POST::class);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }
}