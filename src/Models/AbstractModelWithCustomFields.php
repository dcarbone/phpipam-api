<?php namespace MyENA\PHPIPAMAPI\Models;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class AbstractModelWithCustomFields
 * @package MyENA\PHPIPAMAPI\Models
 */
abstract class AbstractModelWithCustomFields extends AbstractModel implements CustomFieldsContainerInterface {
    /** @var \MyENA\PHPIPAMAPI\Models\CustomField[] */
    protected $custom_fields = [];

    /**
     * AbstractModelWithCustomFields constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        if (!is_array($this->custom_fields)) {
            $this->custom_fields = [];
        }
        foreach($this->custom_fields as $field => &$value) {
            $value = new CustomField($field, $value);
        }
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasCustomField(string $field): bool {
        return isset($this->custom_fields[$field]);
    }

    /**
     * @param string $field
     * @return \MyENA\PHPIPAMAPI\Models\CustomField|null
     */
    public function getCustomField(string $field): ?CustomField {
        return $this->custom_fields[$field] ?? null;
    }
}