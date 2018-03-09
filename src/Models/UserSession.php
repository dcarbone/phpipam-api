<?php namespace MyENA\PHPIPAMAPI\Models;

use DCarbone\Go\Time;
use Psr\Http\Message\ResponseInterface;

/**
 * TODO: This class is more complex than I would like it to be due to wanting to catch token changes...
 *
 * Class UserSession
 * @package MyENA\PHPIPAMAPI\Models
 */
class UserSession implements \JsonSerializable {
    /** @var string */
    protected $token;
    /** @var string */
    protected $expires;

    /** @var \DCarbone\Go\Time\Time */
    protected $time;

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
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    public static function fromPSR7Response(ResponseInterface $response): UserSession {
        $contents = $response->getBody()->getContents();
        $decoded = json_decode($contents);
        if (JSON_ERROR_NONE === json_last_error()) {
            if ('object' === ($type = gettype($decoded))) {
                if (isset($decoded->data) && is_object($decoded->data)) {
                    return self::fromStdClass($decoded->data);
                } else {
                    throw new \DomainException(sprintf(
                        'Expected format of {"data": {"token": "value", "expires": "value"}} not found in %s',
                        $contents
                    ));
                }
            } else if ('array' === $type) {
                if (isset($decoded['data']) && is_array($decoded['data'])) {
                    return self::fromArray($decoded['data']);
                } else {
                    throw new \DomainException(sprintf(
                        'Expected format of ["data" => ["token => "value", "expires" => "value"]] not found in %s',
                        $contents
                    ));
                }
            } else {
                throw new \DomainException(sprintf(
                    'Expected either associative array or object, saw %s',
                    $contents
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
     * @param array $data
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    public static function fromArray(array $data): UserSession {
        if (isset($data['expires'])) {
            return new static($data['token'] ?? '', $data['expires']);
        } else {
            throw new \DomainException(sprintf(
                'Expected format of ["token => "value", "expires" => "value"] not found in %s',
                json_encode($data)
            ));
        }
    }

    /**
     * @param \stdClass $data
     * @return \MyENA\PHPIPAMAPI\Models\UserSession
     */
    public static function fromStdClass(\stdClass $data): UserSession {
        if (isset($data->expires)) {
            return new static($data->token ?? '', $data->expires);
        } else {
            throw new \DomainException(sprintf(
                'Expected format of {"token": "value", "expires": "value"} not found in %s',
                json_encode($data)
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
                    $this->time = Time\Time::createFromFormat(PHPIPAM_DATETIME_FORMAT, $this->expires);
                } catch (\Throwable $e) {
                    throw new \DomainException(sprintf(
                        'Expires not in expected format of "%s": %s',
                        PHPIPAM_DATETIME_FORMAT,
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

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = ['expires' => $this->expires ?? null];
        if (isset($this->token) && '' !== $this->token) {
            $a['token'] = $this->token;
        }
        return $a;
    }
}