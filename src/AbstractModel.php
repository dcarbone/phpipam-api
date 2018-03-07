<?php namespace ENA\PHPIPAMAPI;

/**
 * Class AbstractModel
 * @package ENA\PHPIPAMAPI
 */
abstract class AbstractModel {
    /**
     * AbstractModel constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        foreach ($data as $k => $v) {
            $this->{$k} = $v;
        }
    }
}