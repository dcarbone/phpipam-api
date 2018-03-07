<?php namespace ENA\PHPIPAMAPI\Error;

use ENA\PHPIPAMAPI\Error;

/**
 * Class ClientError
 * @package ENA\PHPIPAMAPI\Response
 */
class ClientError extends Error {
    /**
     * @return bool
     */
    public function transportError(): bool {
        return false;
    }
}