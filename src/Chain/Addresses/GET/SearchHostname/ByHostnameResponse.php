<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPAddress;

/**
 * Class ByHostnameResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname
 */
class ByHostnameResponse extends AbstractResponse {
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
        return $this->data;
    }
}