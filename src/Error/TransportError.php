<?php namespace MyENA\PHPIPAMAPI\Error;

use MyENA\PHPIPAMAPI\Error;

/**
 * Class TransportError
 * @package MyENA\PHPIPAMAPI\Response
 */
class TransportError extends Error {
    /**
     * @return bool
     */
    public function isTransportError(): bool {
        return true;
    }

    /**
     * @return bool
     */
    public function isApiError(): bool {
        return false;
    }
}