<?php namespace MyENA\PHPIPAMAPI\Models;

/**
 * Interface CustomFieldsContainerInterface
 * @package MyENA\PHPIPAMAPI\Models
 */
interface CustomFieldsContainerInterface {
    /**
     * Must return true if this model contains the given custom field name
     *
     * @param string $field
     * @return bool
     */
    public function hasCustomField(string $field): bool;

    /**
     * Must either return the custom field, if seen, or null if the field was not found on this model
     *
     * @param string $field
     * @return \MyENA\PHPIPAMAPI\Models\CustomField|null
     */
    public function getCustomField(string $field): ?CustomField;
}