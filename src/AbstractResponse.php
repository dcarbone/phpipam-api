<?php namespace ENA\PHPIPAMAPI\Response;

use DCarbone\Go\Time;
use DCarbone\Go\Time\Duration;
use ENA\PHPIPAMAPI\Response;

/**
 * Class AbstractResponse
 * @package ENA\PHPIPAMAPI\Response
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
     * @param \ENA\PHPIPAMAPI\Response $response
     */
    public function __construct(Response $response) {
        $this->code = $response->code;
        $this->success = $response->success;
        $this->time = Time::ParseDuration("{$response->time}s");
        $this->parseData($response->data);
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