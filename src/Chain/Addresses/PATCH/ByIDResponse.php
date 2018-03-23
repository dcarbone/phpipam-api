<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\PATCH;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class ByIDResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\PATCH
 */
class ByIDResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = $data;
    }

    /**
     * @return mixed|null
     */
    public function getData() {
        return $this->data ?? null;
    }
}