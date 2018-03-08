<?php namespace MyENA\PHPIPAMAPI\Part;

use MyENA\PHPIPAMAPI\Request;

/**
 * Interface Executable
 * @package MyENA\PHPIPAMAPI
 */
interface ExecutablePart {
    /**
     * @return array(
     * @type mixed|null                     Value will vary depending on call being made
     * @type \MyENA\PHPIPAMAPI\Error|null   Value MUST be Error or null
     * )
     */
    public function execute(): array;

    /**
     * @return \MyENA\PHPIPAMAPI\Request
     */
    public function buildRequest(): Request;
}