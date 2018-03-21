<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\Subnet;

/**
 * Class SlavesResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class SlavesResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        foreach ($data as $datum) {
            $this->data[] = new Subnet($datum);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\Subnet[]
     */
    public function getData(): array {
        return $this->data ?? [];
    }
}