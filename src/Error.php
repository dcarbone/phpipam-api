<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\Error\ClientError;
use ENA\PHPIPAMAPI\Error\ServerError;
use ENA\PHPIPAMAPI\Error\TransportError;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface Error
 * @package ENA\PHPIPAMAPI\Response
 */
abstract class Error {

    /** @var int */
    private $code;
    /** @var string */
    private $reason;

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
    public function code(): int {
        return $this->code;
    }

    /**
     * Returns the raw response message.  See individual implementor classes.
     *
     * @return string
     */
    public function reason(): string {
        return $this->reason;
    }

    /**
     * Returns true if there was a transport error, i.e. the service was unreachable
     *
     * @return bool
     */
    abstract public function transportError(): bool;

    /**
     * Returns true if the response code was in the 4xx block
     *
     * @return bool
     */
    public function clientError(): bool {
        return 400 <= $this->code && $this->code < 500;
    }

    /**
     * Returns true if the response code was in the 5xx block
     *
     * @return bool
     */
    public function serverError(): bool {
        return 500 <= $this->code && $this->code < 600;
    }

    /**
     * @param \Exception $e
     * @return \ENA\PHPIPAMAPI\Error\TransportError
     */
    public static function fromException(\Exception $e): Error {
        return new TransportError($e->getCode(), $e->getMessage());
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \ENA\PHPIPAMAPI\Error|null
     */
    public static function fromResponse(ResponseInterface $response): ?Error {
        $code = $response->getStatusCode();
        if (400 <= $code && $code < 500) {
            return new ClientError($code, $response->getBody()->getContents());
        } else if (500 <= $code && $code < 600) {
            return new ServerError($code, $response->getBody()->getContents());
        } else {
            // TODO: is this ok?
            return new TransportError($response->getStatusCode(), $response->getBody()->getContents());
        }
    }
}