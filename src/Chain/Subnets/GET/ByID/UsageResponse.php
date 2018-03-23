<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\Subnet\Usage as SubnetUsage;

/**
 * Class UsageResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class UsageResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = new SubnetUsage($data);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\Subnet\Usage|null
     */
    public function getData(): ?SubnetUsage {
        return $this->data ?? null;
    }
}