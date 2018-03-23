<?php namespace MyENA\PHPIPAMAPI\Chain\User;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\UserSession;

/**
 * Class POSTResponse
 * @package MyENA\PHPIPAMAPI\Chain\User
 */
class POSTResponse extends AbstractResponse {
    /**
     * @param array $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = UserSession::fromArray($data);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    public function getData(): ?UserSession {
        return $this->data ?? null;
    }
}