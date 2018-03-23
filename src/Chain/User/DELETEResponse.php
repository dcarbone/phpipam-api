<?php namespace MyENA\PHPIPAMAPI\Chain\User;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class DELETEResponse
 * @package MyENA\PHPIPAMAPI\Chain\User
 */
class DELETEResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = $data;
        }
    }

    /**
     * @return array|null
     */
    public function getData(): ?array {
        return $this->data ?? null;
    }
}