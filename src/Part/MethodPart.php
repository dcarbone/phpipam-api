<?php namespace MyENA\PHPIPAMAPI\Part;

/**
 * Interface MethodPart
 * @package MyENA\PHPIPAMAPI\Part
 */
interface MethodPart {
    /**
     * @return string
     */
    public function getRequestMethod(): string;
}