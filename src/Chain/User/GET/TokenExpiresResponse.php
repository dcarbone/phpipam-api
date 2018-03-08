<?php namespace MyENA\PHPIPAMAPI\Chain\User\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\UserSession;

/**
 * Class TokenExpiresResponse
 * @package MyENA\PHPIPAMAPI\Chain\User\GET
 */
class TokenExpiresResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        $this->data = UserSession::fromArray($data);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    public function getData(): UserSession {
        return $this->data;
    }
}