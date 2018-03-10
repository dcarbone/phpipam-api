<?php namespace MyENA\PHPIPAMAPI\Parameter\Validator;

use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Parameter\Validator;

/**
 * Class IPv4Validator
 * @package MyENA\PHPIPAMAPI\Parameter\Validator
 */
class IPv4Validator implements Validator {
    const NAME = 'ipv4';

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
            $v = $parameter->getDefaultValue();
        }
        return is_string($v) && filter_var($v, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
}