<?php namespace MyENA\PHPIPAMAPI;

use DCarbone\Go\Time;
use DCarbone\Go\Time\Duration;
use MyENA\PHPIPAMAPI\Error\ResponseError;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractResponse
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractResponse {
    /** @var int */
    protected $code = 0;
    /** @var bool */
    protected $success = false;
    /** @var \DCarbone\Go\Time\Duration */
    protected $time;

    /** @var mixed */
    protected $data;

    /** @var string|null */
    protected $message;

    /**
     * AbstractResponse constructor.
     * @param int $code
     * @param bool $success
     * @param string $time
     * @param mixed $data
     * @param null|string $message
     */
    public function __construct(int $code, bool $success, string $time, $data = [], ?string $message = null) {
        $this->code = $code;
        $this->success = $success;
        $this->time = Time::ParseDuration("{$time}s");
        $this->message = $message;
        $this->parseData($data);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Log\LoggerInterface $logger
     * @return array(
     * @type static                     Decoded response, if no errors were seen
     * @type \MyENA\PHPIPAMAPI\Error      Error description, if encountered
     * )
     */
    public static function fromPSR7Response(ResponseInterface $response, LoggerInterface $logger): array {
        // TODO: Don't like calling rewind here...
        $response->getBody()->rewind();
        $contents = $response->getBody()->getContents();
        $response->getBody()->close();
        $decoded = json_decode($contents, true);
        if (JSON_ERROR_NONE === json_last_error()) {
            if (is_array($decoded)) { // TODO: better test for root object
                if (isset($decoded['code']) &&
                    isset($decoded['success']) &&
                    (isset($decoded['data']) || isset($decoded['message'])) &&
                    isset($decoded['time'])) {
                    return [
                        new static($decoded['code'],
                            $decoded['success'],
                            $decoded['time'],
                            $decoded['data'] ?? [],
                            $decoded['message'] ?? null),
                        null,
                    ];
                } else {
                    return [
                        null,
                        new ResponseError(-1, sprintf(
                            'Response expected to have fields ["code","success","data","error"], saw ["%s"]',
                            implode('","', array_keys($decoded))
                        ), $contents),
                    ];
                }
            } else {
                return [
                    null,
                    new ResponseError(-1, sprintf(
                        'Response expected to be json-encoded object, saw "%s"',
                        gettype($decoded)
                    ), $contents),
                ];
            }
        } else {
            return [
                null,
                new ResponseError(json_last_error(), sprintf(
                    'Response returned invalid JSON: %s',
                    json_last_error_msg()
                ), $contents),
            ];
        }
    }

    /**
     * @return int
     */
    public function getCode(): int {
        return $this->code;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool {
        return $this->success;
    }

    /**
     * @return \DCarbone\Go\Time\Duration
     */
    public function getTime(): Duration {
        return $this->time;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string {
        return $this->message;
    }

    /**
     * @param mixed $data
     */
    abstract protected function parseData($data): void;
}