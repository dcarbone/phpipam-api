<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags\ByID;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class Tags
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET
 */
class Tags extends AbstractPart implements UriPart, ExecutablePart {
    const PATH = 'tags/';

    /**
     * @param int $id
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags\ByID
     */
    public function ByID(int $id): ByID {
        return $this->newPart(ByID::class, ['id' => $id]);
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\GET\TagsResponse|null
     * @type \MyENA\PHPIPAMAPI\Error|null
     * )
     */
    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        return TagsResponse::fromPSR7Response($resp, $this->logger);
    }
}