<?php namespace MyENA\PHPIPAMAPI\Part;

/**
 * Interface ParamPart
 * @package MyENA\PHPIPAMAPI\Part
 */
interface ParamPart {

    /**
     * Must return array of Parameters that will be used on execution.
     *
     * @return \MyENA\PHPIPAMAPI\Parameter[]
     */
    public function getParameters(): array;
}