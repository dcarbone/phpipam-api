<?php namespace MyENA\PHPIPAMAPI\User;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class PATCHResponse
 * @package MyENA\PHPIPAMAPI\User
 */
class PATCHResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = new PATCHResponseData($data);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\User\PATCHResponseData
     */
    public function getData(): PATCHResponseData {
        return $this->data;
    }
}