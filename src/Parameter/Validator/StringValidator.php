<?php namespace MyENA\PHPIPAMAPI\Parameter\Validator;

use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Parameter\Validator;

/**
 * Class StringValidator
 * @package MyENA\PHPIPAMAPI\Argument\Validator
 */
class StringValidator implements Validator {
    const NAME = 'string';

    /**
     * @return string
     */
    public function name(): string {
        return self::NAME;
    }

    /**
     * @param \MyENA\PHPIPAMAPI\Parameter $argument
     * @return bool
     */
    public function test(Parameter $argument): bool {
        return is_string($argument->getValue());
    }
}