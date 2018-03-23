<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\Subnet;

/**
 * Class ByIDResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class ByIDResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = new Subnet($data);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\Subnet|null
     */
    public function getData(): ?Subnet {
        return $this->data ?? null;
    }
}