<?php namespace MyENA\PHPIPAMAPI\Parameter;

use MyENA\PHPIPAMAPI\Parameter;

/**
 * Interface Validator
 * @package MyENA\PHPIPAMAPI\Argument
 */
interface Validator {
    /**
     * Validator name
     *
     * @return string
     */
    public function name(): string;

    /**
     * Performs validity check on provided argument
     *
     * @param \MyENA\PHPIPAMAPI\Parameter $argument
     * @return bool
     */
    public function test(Parameter $argument): bool;
}