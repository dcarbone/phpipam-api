<?php namespace MyENA\PHPIPAMAPI\Chain\User;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\MethodPart;

/**
 * Class PATCH
 * @package MyENA\PHPIPAMAPI\Chain\User
 */
class PATCH extends AbstractPart implements MethodPart, ExecutablePart {
    const METHOD = 'PATCH';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\User\PATCHResponse|null
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
        return PATCHResponse::fromPSR7Response($resp, $this->logger);
    }
}