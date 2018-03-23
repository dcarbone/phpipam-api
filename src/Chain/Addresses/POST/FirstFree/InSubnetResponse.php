<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree;


use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class InSubnetResponse
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree
 */
class InSubnetResponse extends AbstractResponse {
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
}