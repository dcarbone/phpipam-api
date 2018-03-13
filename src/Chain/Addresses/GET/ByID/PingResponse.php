<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\IPAddressPing;

/**
 * Class PingResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\ByID
 */
class PingResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = new IPAddressPing($data);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\IPAddressPing|null
     */
    public function getData(): ?IPAddressPing {
        return $this->data ?? null;
    }
}