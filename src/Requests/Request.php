<?php namespace ENA\PHPIPAMAPI\Requests;

use Psr\Http\Message\UriInterface;

/**
 * Interface Request
 * @package ENA\PHPIPAMAPI\Requests
 */
interface Request {
    /**
     * @return string
     */
    public function path(): string;

    /**
     * Must return a serializable or null if nothing is to be sent
     *
     * @return mixed
     */
    public function body();
}