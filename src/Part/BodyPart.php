<?php namespace MyENA\PHPIPAMAPI\Part;

/**
 * Interface BodyPart
 * @package MyENA\PHPIPAMAPI\Part
 */
interface BodyPart extends HeaderPart {

    // Extending header, as you should probably set the Content-Type in there.

    /**
     * Must return the body to be used in this request
     *
     * @return mixed
     */
    public function getBody();
}