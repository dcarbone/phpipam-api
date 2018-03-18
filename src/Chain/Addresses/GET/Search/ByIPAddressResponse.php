<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPAddress;

/**
 * Class ByIPAddressResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search
 */
class ByIPAddressResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        foreach ($data as $datum) {
            $this->data[] = new IPAddress($datum);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\IPAddress[]
     */
    public function getData(): array {
        return $this->data ?? [];
    }
}