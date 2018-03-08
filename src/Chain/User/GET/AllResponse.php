<?php namespace MyENA\PHPIPAMAPI\Chain\User\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\User;

/**
 * Class AllResponse
 * @package MyENA\PHPIPAMAPI\Chain\User\GET
 */
class AllResponse extends AbstractResponse {
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