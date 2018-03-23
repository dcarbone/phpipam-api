<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\DELETE;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class ByIDResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\DELETE
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