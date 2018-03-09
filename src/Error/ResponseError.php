<?php namespace MyENA\PHPIPAMAPI\Error;

use MyENA\PHPIPAMAPI\Error;

/**
 * Class ResponseError
 * @package MyENA\PHPIPAMAPI\Error
 */
class ResponseError extends Error {
    /** @var string */
    protected $contents;

    /**
     * ResponseError constructor.
     * @param int $code
     * @param string $reason
     * @param string $contents
     */
    public function __construct(int $code, string $reason, string $contents = '') {
        parent::__construct($code, $reason);
        $this->contents = $contents;
    }

    /**
     * @return bool
     */
    public function isTransportError(): bool {
        return false;
    }

    /**
     * TODO: Different type maybe?
     *
     * @return bool
     */
    public function isApiError(): bool {
        return true;
    }

    /**
     * Will contain the raw output from the body of the response
     *
     * @return string
     */
    public function getContents(): string {
        return $this->contents;
    }
}