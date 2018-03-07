<?php namespace ENA\PHPIPAMAPI\Request;

use ENA\PHPIPAMAPI\Request;

/**
 * Interface RequestProvider
 * @package ENA\PHPIPAMAPI\Request
 */
interface RequestProvider {
    /**
     * @return \ENA\PHPIPAMAPI\Request
     */
    public function toRequest(): Request;
}