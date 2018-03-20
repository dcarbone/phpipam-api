<?php namespace MyENA\PHPIPAMAPI\Models;

/**
 * Class CustomField
 * @package MyENA\PHPIPAMAPI\Models
 */
class CustomField implements \JsonSerializable {
    /** @var string */
    protected $name;
    /** @var mixed */
    protected $value;

    /**
     * CustomField constructor.
     * @param string $name
     * @param null $value
     */
    public function __construct(string $name, $value = null) {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isNull(): bool {
        return null === $this->getValue();
    }

    /**
     * TODO: is this sufficient?
     *
     * @return string
     */
    public function __toString() {
        switch(gettype(($value = $this->getValue()))){
            case 'string':
            case 'integer':
            case 'double':
                return (string)$value;
            case 'object':
                if (method_exists($value, '__toString')) {
                    return (string)$value;
                }
                return get_class($value);
            case 'array':
                return 'Array['.count($value).']';
            case 'resource':
                return 'Resource(#'.(int)$value.')';

            default:
                return 'NULL';
        }
    }

    /**
     * @return mixed
     */
    public function jsonSerialize() {
        return $this->getValue();
    }
}