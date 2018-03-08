<?php namespace MyENA\PHPIPAMAPI;

use DCarbone\Go\Time;
use DCarbone\Go\Time\Duration;
use MyENA\PHPIPAMAPI\Error\ApiError;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractResponse
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractResponse {
    /** @var int */
    private $code = 0;
    /** @var bool */
    private $success = false;
    /** @var \DCarbone\Go\Time\Duration */
    private $time;

    /** @var mixed */
    protected $data;

    /**
     * AbstractResponse constructor.
     * @param int $code
     * @param bool $success
     * @param mixed $data
     * @param string $time
     */
    public function __construct(int $code, bool $success, $data, string $time) {
        $this->code = $code;
        $this->success = $success;
        $this->time = Time::ParseDuration("{$time}s");
        $this->parseData($data);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array(
     * @type static                     Decoded response, if no errors were seen
     * @type \MyENA\PHPIPAMAPI\Error      Error description, if encountered
     * )
     */
    public static function fromPSR7Response(ResponseInterface $response): array {
        // TODO: Don't like calling rewind here...
        $response->getBody()->rewind();
        $contents = $response->getBody()->getContents();
        $response->getBody()->close();
        $decoded = json_decode($contents, true);
        if (JSON_ERROR_NONE === json_last_error()) {
            if (is_array($decoded)) { // TODO: better test for root object
                if (isset($decoded['code']) &&
                    isset($decoded['success']) &&
                    // TODO: are there responses that are "OK" but have something other than a "data" field?
                    isset($decoded['data']) &&
                    isset($decoded['time'])) {
                    return [
                        new static($decoded['code'], $decoded['success'], $decoded['data'], $decoded['time']),
                        null,
                    ];
                } else {
                    return [
                        null,
                        new ApiError(-1, sprintf(
                            'Response expected to have fields ["code","success","data","error"], saw ["%s"]',
                            implode('","', array_keys($decoded))
                        )),
                    ];
                }
            } else {
                return [
                    null,
                    new ApiError(-1, sprintf(
                        'Response expected to be json-encoded object, saw "%s"',
                        gettype($decoded)
                    )),
                ];
            }
        } else {
            return [
                null,
                new ApiError(-1, sprintf(
                    'Response returned invalid JSON: %s',
                    json_last_error_msg()
                )),
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
    public function success(): bool {
        return $this->success;
    }

    /**
     * @return \DCarbone\Go\Time\Duration
     */
    public function time(): Duration {
        return $this->time;
    }

    /**
     * @param mixed $data
     */
    abstract protected function parseData($data): void;
}