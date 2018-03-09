<?php namespace MyENA\PHPIPAMAPI\Part;

/**
 * Interface HeaderPart
 * @package MyENA\PHPIPAMAPI\Part
 */
interface HeaderPart {
    /**
     * Must return an array of ["header" => "value"] or ["header" => ["value1", "value2"]]
     *
     * @return array
     */
    public function getRequestHeaders(): array;
}