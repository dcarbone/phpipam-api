<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AllSubnets;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class WithMaskResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AllSubnets
 */
class WithMaskResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = $data;
        }
    }

    /**
     * @return string[]
     */
    public function getData(): array {
        return $this->data ?? [];
    }
}