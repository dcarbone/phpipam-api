<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPTag;

/**
 * Class TagsResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class TagsResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        if (is_array($data)) {
            foreach ($data as $datum) {
                $this->data[] = new IPTag($datum);
            }
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\IPTag[]
     */
    public function getData(): array {
        return $this->data ?? [];
    }
}