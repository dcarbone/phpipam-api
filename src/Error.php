<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\Error\TransportError;

/**
 * Interface Error
 * @package ENA\PHPIPAMAPI\Response
 */
abstract class Error implements \JsonSerializable {

    /** @var int */
    protected $code;
    /** @var string */
    protected $reason;

    /**
     * Error constructor.
     * @param int $code
     * @param string $reason
     */
    public function __construct(int $code, string $reason) {
        $this->code = $code;
        $this->reason = $reason;
    }

    /**
     * Returns the code as it makes sense in the scope of the error.
     *
     * @return int
     */
    public function getCode(): int {
        return $this->code;
    }

    /**
     * Returns the raw response message.  See individual implementor classes.
     *
     * @return string
     */
    public function getReason(): string {
        return $this->reason;
    }

    /**
     * Returns true if there was a transport error, i.e. the service was unreachable
     *
     * @return bool
     */
    abstract public function isTransportError(): bool;

    /**
     * Returns true if an error was returned by the service
     *
     * @return bool
     */
    abstract public function isApiError(): bool;

    /**
     * Returns true if the response code was in the 4xx block
     *
     * @return bool
     */
    public function isClientError(): bool {
        return 400 >= $this->code && $this->code < 500;
    }

    /**
     * Returns true if the response code was in the 5xx block
     *
     * @return bool
     */
    public function isServerError(): bool {
        return 500 >= $this->code && $this->code < 600;
    }

    /**
     * @param \Exception $e
     * @return \ENA\PHPIPAMAPI\Error\TransportError
     */
    public static function fromException(\Exception $e): Error {
        return new TransportError($e->getCode(), $e->getMessage());
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'code'   => $this->getCode(),
            'reason' => $this->getReason(),
        ];
    }

    /**
     * @return string
     */
    public function __toString() {
        return "{$this->code}: {$this->reason}";
    }
}