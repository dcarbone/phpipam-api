<?php namespace MyENA\PHPIPAMAPI\Parameter\Validator;

use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Parameter\Validator;

/**
 * Class MACValidator
 * @package MyENA\PHPIPAMAPI\Parameter\Validator
 */
class MACValidator implements Validator {
    const NAME = 'mac';

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
        return is_string($v) && filter_var($v, FILTER_VALIDATE_MAC);
    }
}
