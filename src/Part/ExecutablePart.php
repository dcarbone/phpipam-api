<?php namespace MyENA\PHPIPAMAPI\Part;

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
}