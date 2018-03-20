<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class POST
 * @package MyENA\PHPIPAMAPI\Request\Addresses
 */
class POST extends AbstractPart implements MethodPart, ExecutablePart {
    const METHOD = 'POST';

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree
     */
    public function FirstFree(): FirstFree {
        return $this->newPart(FirstFree::class);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    public function execute(): array {
        // TODO: Implement execute() method.
    }
}