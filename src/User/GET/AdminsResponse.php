<?php namespace MyENA\PHPIPAMAPI\User\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\User;

/**
 * Class AdminsResponse
 * @package MyENA\PHPIPAMAPI\User\GET
 */
class AdminsResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = [];
        foreach ($data as $datum) {
            $this->data[] = new User($datum);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\User[]
     */
    public function getData(): array {
        return $this->data;
    }
}