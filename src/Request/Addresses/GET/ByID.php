<?php namespace ENA\PHPIPAMAPI\Request\Addresses\GET;

use ENA\PHPIPAMAPI\Client;
use ENA\PHPIPAMAPI\Request;
use ENA\PHPIPAMAPI\Request\Addresses\GET;

/**
 * Class ByID
 * @package ENA\PHPIPAMAPI\Request\Addresses\GET
 */
class ByID {
    /** @var \ENA\PHPIPAMAPI\Client */
    private $client;

    /** @var \ENA\PHPIPAMAPI\Request\Addresses\GET */
    private $get;

    /** @var string */
    private $id;

    /**
     * ByID constructor.
     * @param \ENA\PHPIPAMAPI\Client $client
     * @param \ENA\PHPIPAMAPI\Request\Addresses\GET $GET
     * @param string $id
     */
    public function __construct(Client $client, GET $GET, string $id) {
        $this->client = $client;
        $this->get = $GET;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string {
        return $this->id;
    }

    public function execute() {
        $r = new Request('get', Request\Addresses::ROOT_PATH."/{$this->id}/");

    }
}