<?php namespace MyENA\PHPIPAMAPI\Models;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class CustomField
 * @package MyENA\PHPIPAMAPI\Models
 */
class CustomField extends AbstractModel {
    /** @var string|null */
    protected $name = '';
    /** @var string|null */
    protected $type = '';
    /** @var string|null */
    protected $Comment = '';
    /** @var string|null */
    protected $Null = '';
    /** @var mixed  */
    protected $Default = null;

    /**
     * @return null|string
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getComment(): ?string {
        return $this->Comment;
    }

    /**
     * @return null|string
     */
    public function getNull(): ?string {
        return $this->Null;
    }

    /**
     * @return mixed
     */
    public function getDefault() {
        return $this->Default;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}