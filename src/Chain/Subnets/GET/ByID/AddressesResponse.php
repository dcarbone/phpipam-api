<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPAddress;

/**
 * Class AddressesResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class AddressesResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        if (is_array($data)) {
            foreach ($data as $datum) {
                $this->data[] = new IPAddress($datum);
            }
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\IPAddress[]
     */
    public function getData(): array {
        return $this->data ?? [];
    }
}