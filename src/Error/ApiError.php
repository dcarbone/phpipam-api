<?php namespace MyENA\PHPIPAMAPI\Error;

use DCarbone\Go\Time;
use MyENA\PHPIPAMAPI\Error;

/**
 * Class ApiError
 * @package MyENA\PHPIPAMAPI\Error
 */
class ApiError extends Error {
    /** @var bool */
    protected $success = false;
    /** @var \DCarbone\Go\Time\Duration */
    protected $time;

    /**
     * ApiError constructor.
     * @param int $code
     * @param string $reason
     */
    public function __construct(int $code, string $reason) {
        parent::__construct($code, $reason);
        $decoded = json_decode($reason);
        if (JSON_ERROR_NONE === json_last_error()) {
            if (is_object($decoded)) {
                if (isset($decoded->message)) {
                    $this->reason = $decoded->message;
                }
                if (isset($decoded->success)) {
                    $this->success = (bool)$decoded->success;
                }
                if (isset($decoded->time)) {
                    $this->time = Time::ParseDuration("{$decoded->time}s");
                }
            }
        }
        if (!isset($this->time)) {
            $this->time = new Time\Duration();
        }
    }

    /**
     * @return bool
     */
    public function isTransportError(): bool {
        return false;
    }

    /**
     * @return bool
     */
    public function isApiError(): bool {
        return true;
    }

    /**
     * @return bool
     */
    public function wasSuccess(): bool {
        return $this->success;
    }

    /**
     * @return \DCarbone\Go\Time\Duration
     */
    public function getTime(): Time\Duration {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->getReason();
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = parent::jsonSerialize();
        unset($a['reason']);
        $a['message'] = $this->getMessage();
        $a['time'] = $this->getTime()->Seconds();
        $a['success'] = $this->wasSuccess();
        return $a;
    }
}