<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class FirstFreeResponse
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID
 */
class FirstFreeResponse extends AbstractResponse {
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