<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstSubnet;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class WithMaskResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstSubnet
 */
class WithMaskResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_string($data)) {
            $this->data = $data;
        }
    }

    /**
     * @return null|string
     */
    public function getData(): ?string {
        return $this->data ?? null;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->data ?? '';
    }
}