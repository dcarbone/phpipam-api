<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\CustomFieldDefinition;

/**
 * Class CustomFieldsResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class CustomFieldsResponse extends AbstractResponse {
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