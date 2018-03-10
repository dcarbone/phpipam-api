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
     * @param \MyENA\PHPIPAMAPI\Parameter $parameter
     * @return bool
     */
    public function test(Parameter $parameter): bool {
        return is_string($parameter->getValue());
    }
}