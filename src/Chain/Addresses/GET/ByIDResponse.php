<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPAddress;

/**
 * Class ByIDResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class ByIDResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = new IPAddress($data);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\IPAddress|null
     */
    public function getData(): ?IPAddress {
        return $this->data ?? null;
    }
}