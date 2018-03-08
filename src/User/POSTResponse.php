<?php namespace MyENA\PHPIPAMAPI\User;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\UserSession;

/**
 * Class POSTResponse
 * @package MyENA\PHPIPAMAPI\User
 */
class POSTResponse extends AbstractResponse {
    /**
     * @param array $data
     */
    protected function parseData($data): void {
        $this->data = UserSession::fromArray($data);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    public function getData(): ?UserSession {
        return $this->data ?? null;
    }
}