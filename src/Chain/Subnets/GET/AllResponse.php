<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\Subnet;

/**
 * Class AllResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class AllResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        foreach($data as $datum) {
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