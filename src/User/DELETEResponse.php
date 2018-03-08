<?php namespace MyENA\PHPIPAMAPI\User;

use MyENA\PHPIPAMAPI\AbstractResponse;

/**
 * Class DELETEResponse
 * @package MyENA\PHPIPAMAPI\User
 */
class DELETEResponse extends AbstractResponse {
    /**
     * @param mixed $data
     */
    protected function parseData($data): void {
        if (!is_array($data)) {
            throw new \DomainException(sprintf(
                'DELETE /users/ expected "data" property to be object, saw %s',
                gettype($data)
            ));
        }
        $this->data = $data;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array {
        return $this->data ?? null;
    }
}