<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPTag;

/**
 * Class ByIDResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags
 */
class ByIDResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = new IPTag($data);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\IPTag
     */
    public function getData(): ?IPTag {
        return $this->data ?? null;
    }
}