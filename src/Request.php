<?php namespace MyENA\PHPIPAMAPI;

/**
 * Class Request
 * @package MyENA\PHPIPAMAPI\Request
 */
class Request {
    /** @var string */
    private $method;
    /** @var string */
    private $uri;
    /** @var */
    private $headers;
    /** @var array */
    private $parameters;
    /** @var null */
    private $body;
    /** @var bool */
    private $authenticated;

    /** @var array */
    private static $methods = [
        'GET'    => true,
        'POST'   => true,
        'PUT'    => true,
        'DELETE' => true,
        'PATCH'  => true,
    ];

    /**
     * Request constructor.
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param array $parameters
     * @param null $body
     * @param bool $authenticated
     */
    public function __construct(string $method,
                                string $uri,
                                array $headers = [],
                                array $parameters = [],
                                $body = null,
                                bool $authenticated = true) {
        $this->method = strtoupper(trim($method));
        $this->uri = trim($uri);
        $this->headers = $headers;
        $this->parameters = $parameters;
        $this->body = $body;
        $this->authenticated = $authenticated;
        $this->validate();
    }

    /**
     * @return string
     */
    public function method(): string {
        return $this->method;
    }

    /**
     * @return string
     */
    public function uri(): string {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function headers(): array {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function parameters(): array {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function body() {
        return $this->body;
    }

    /**
     * Returns true if the request requires an open auth session to execute
     *
     * @return bool
     */
    public function authenticated(): bool {
        return $this->authenticated;
    }

    private function validate() {
        if (!isset(self::$methods[$this->method])) {
            throw new \InvalidArgumentException("Method \"{$this->method}\" is not valid");
        }
        if ('' === $this->uri) {
            throw new \InvalidArgumentException('uri cannot be empty');
        }
    }
}