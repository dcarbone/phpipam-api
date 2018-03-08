<?php namespace MyENA\PHPIPAMAPI;

use DCarbone\Go\Time;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClientSession
 * @package MyENA\PHPIPAMAPI
 */
class ClientSession {
    /** @var string */
    private $token;
    /** @var string */
    private $expires;

    /** @var \DCarbone\Go\Time\Time */
    private $time;

    /**
     * ClientSession constructor.
     * @param string $token
     * @param string $expires
     */
    public function __construct(string $token, string $expires) {
        $this->token = $token;
        $this->expires = $expires;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \MyENA\PHPIPAMAPI\ClientSession
     */
    public static function fromPSR7Response(ResponseInterface $response): ClientSession {
        $decoded = json_decode($response->getBody()->getContents());
        if (JSON_ERROR_NONE === json_last_error()) {
            if (is_object($decoded) &&
                isset($decoded->data) &&
                is_object($decoded->data) &&
                isset($decoded->data->token) &&
                isset($decoded->data->expires)) {
                return new static($decoded->data->token, $decoded->data->expires);
            } else {
                throw new \DomainException(sprintf(
                    'Expected format of ["token => "value", "expires" => "value"] not found in %s',
                    $decoded
                ));
            }
        } else {
            throw new \DomainException(sprintf(
                'Unable to construct ClientSession from response: %s',
                json_last_error_msg()
            ));
        }
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getExpires(): string {
        return $this->expires;
    }

    /**
     * @return \DCarbone\Go\Time\Time
     */
    public function getExpiresTime(): Time\Time {
        if (!isset($this->time)) {
            if ('' === $this->expires) {
                $this->time = Time::New();
            } else {
                try {
                    $this->time = Time\Time::createFromFormat(PHPIPAM_TOKEN_EXPIRES_FORMAT, $this->expires);
                } catch (\Throwable $e) {
                    throw new \DomainException(sprintf(
                        'Expires not in expected format of "%s": %s',
                        PHPIPAM_TOKEN_EXPIRES_FORMAT,
                        $this->expires
                    ));
                }
            }
        }
        return $this->time;
    }

    /**
     * @param string $expires
     */
    public function refresh(string $expires): void {
        $this->expires = $expires;
        $this->time = null;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function refreshFromPSR7Response(ResponseInterface $response): void {
        $decoded = json_decode($response->getBody()->getContents());
        if (JSON_ERROR_NONE === json_last_error()) {
            if (is_object($decoded) &&
                isset($decoded->data) &&
                is_object($decoded->data) &&
                isset($decoded->data->expires)) {
                $this->refresh($decoded->data->expires);
            } else {
                throw new \DomainException(sprintf(
                    'Expected format of ["expires" => "value"] not found in %s',
                    $decoded
                ));
            }
        } else {
            throw new \DomainException(sprintf(
                'Unable to refresh ClientSession from response: %s',
                json_last_error_msg()
            ));
        }
    }
}