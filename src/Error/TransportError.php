<?php namespace ENA\PHPIPAMAPI\Error;

use ENA\PHPIPAMAPI\Error;

/**
 * Class TransportError
 * @package ENA\PHPIPAMAPI\Response
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