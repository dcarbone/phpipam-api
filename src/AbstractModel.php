<?php namespace MyENA\PHPIPAMAPI;

/**
 * Class AbstractModel
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractModel implements \JsonSerializable, \Serializable {
    private $keys = [];

    /**
     * AbstractModel constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        foreach ($data as $k => $v) {
            $this->{$k} = $v;
            $this->keys[] = $k;
        }
    }

    /**
     * @return string
     */
    public function serialize() {
        $d = [];
        foreach ($this->keys as $key) {
            $d[$key] = $this->{$key};
        }
        return serialize($d);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized) {
        $d = unserialize($serialized);
        foreach ($d as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
                $this->keys[] = $k;
            } else {
                trigger_error(
                    sprintf('Class %s has no field named %s', __CLASS__, $k),
                    E_USER_WARNING
                );
            }
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = [];
        foreach ($this->keys as $key) {
            $a[$key] = $this->{$key};
        }
        return $a;
    }
}