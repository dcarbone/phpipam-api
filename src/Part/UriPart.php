<?php namespace MyENA\PHPIPAMAPI\Part;

/**
 * Interface UriPart
 * @package MyENA\PHPIPAMAPI\Part
 */
interface UriPart {
    /**
     * @return string
     */
    public function getUriPart(): string;
}