<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Addresses;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPAddress;

/**
 * Class ByIPResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Addresses
 */
class ByIPResponse extends AbstractResponse {
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