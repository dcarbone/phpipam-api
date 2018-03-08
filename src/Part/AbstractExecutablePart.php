<?php namespace MyENA\PHPIPAMAPI\Part;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Request;

/**
 * Class AbstractExecutablePart
 * @package MyENA\PHPIPAMAPI\Part
 */
abstract class AbstractExecutablePart extends AbstractPart implements ExecutablePart {
    /**
     * @return \MyENA\PHPIPAMAPI\Request
     */
    public function buildRequest(): Request {
        return new Request(
            $this->findMethod(),
            $this->buildUri()
        );
    }
}