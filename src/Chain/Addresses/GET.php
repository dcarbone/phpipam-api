<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\ByID;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\FirstFree;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class GET
 * @package MyENA\PHPIPAMAPI\Request\Addresses
 */
class GET extends AbstractPart implements MethodPart {
    const METHOD = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * @param string $id
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\ByID
     */
    public function ByID(string $id): ByID {
        return $this->newPart(ByID::class, $id);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search
     */
    public function Search(): Search {
        return $this->newPart(Search::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\FirstFree
     */
    public function FirtFree(): FirstFree {
        return $this->newPart(FirstFree::class);
    }
}