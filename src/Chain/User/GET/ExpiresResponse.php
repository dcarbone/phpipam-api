<?php namespace MyENA\PHPIPAMAPI\Chain\User\GET;

use MyENA\PHPIPAMAPI\AbstractResponse;
use MyENA\PHPIPAMAPI\Models\UserSession;

/**
 * Class ExpiresResponse
 * @package MyENA\PHPIPAMAPI\Chain\User\GET
 */
class ExpiresResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (is_array($data)) {
            $this->data = UserSession::fromArray($data);
        }
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\UserSession|null
     */
    public function getData(): ?UserSession {
        return $this->data ?? null;
    }
}