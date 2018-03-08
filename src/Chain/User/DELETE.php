<?php namespace MyENA\PHPIPAMAPI\Chain\User;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Error\ApiError;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\MethodPart;
use MyENA\PHPIPAMAPI\Request;

/**
 * Class DELETE
 * @package MyENA\PHPIPAMAPI\Chain\User
 */
class DELETE extends AbstractPart implements MethodPart, ExecutablePart {
    const METHOD = 'DELETE';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * Perform user logout
     *
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\User\DELETEResponse|null
     * @type \MyENA\PHPIPAMAPI\Error|null
     * )
     */
    public function execute(): array {
        // manually check for token as we do not want to accidentally initiate a login cycle if we're just going to log
        // out anyway...
        if (null === ($cs = $this->client->getClientUserSession())) {
            return [null, new ApiError(400, 'Client session is not open')];
        }
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        return DELETEResponse::fromPSR7Response($resp);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Request
     */
    public function buildRequest(): Request {
        $cs = $this->client->getClientUserSession();
        return new Request(
            $this->findMethod(),
            $this->buildUri(),
            [PHPIPAM_TOKEN_HEADER => null === $cs ? '' : $cs->getToken()],
            [],
            null,
            false
        );
    }
}