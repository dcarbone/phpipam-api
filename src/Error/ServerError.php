<?php namespace ENA\PHPIPAMAPI\Error;

use ENA\PHPIPAMAPI\Error;

/**
 * Class ServerError
 * @package ENA\PHPIPAMAPI\Response
 */
class ServerError extends Error {
    /**
     * @return bool
     */
    public function transportError(): bool {
        return false;
    }
}