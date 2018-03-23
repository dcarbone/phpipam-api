<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class InSubnetResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP
 */
class InSubnetResponse extends AbstractResponse {
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