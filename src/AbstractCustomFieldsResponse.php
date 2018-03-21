<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\Models\CustomFieldDefinition;

/**
 * Class AbstractCustomFieldsResponse
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractCustomFieldsResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        foreach($data as $k => $datum) {
            $this->data[$k] = new CustomFieldDefinition($datum);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\CustomFieldDefinition[]
     */
    public function getData(): array {
        return $this->data ?? [];
    }
}