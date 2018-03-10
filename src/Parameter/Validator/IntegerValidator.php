<?php namespace MyENA\PHPIPAMAPI\Parameter\Validator;

use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Parameter\Validator;

/**
 * Class IntegerValidator
 * @package MyENA\PHPIPAMAPI\Parameter\Validator
 */
class IntegerValidator implements Validator {
    const NAME = 'integer';

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
        $v = $parameter->getValue();
        if (null === $v) {
            return false;
        }
        if ('-' === $v[0] || '+' === $v[0]) {
            return ctype_digit(substr($v, 1));
        }
        return ctype_digit($v);
    }
}