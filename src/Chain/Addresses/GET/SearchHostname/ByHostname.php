<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ByHostname
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname
 */
class ByHostname extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{hostname}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters = [];

    /**
     * SearchHostname constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\AbstractPart[] ...$parents
     */
    public function __construct(\MyENA\PHPIPAMAPI\Client $client, AbstractPart ...$parents) {
        parent::__construct($client, ...$parents);
        $this->parameters = [
            (new Parameter('hostname', Parameter::IN_ROUTE))
                ->required()
                ->addValidator(Parameter\Validators::String()),
        ];
    }

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array
     */
    public function getParameters(): array {
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostname\ByHostnameResponse|null
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
        return ByHostnameResponse::fromPSR7Response($resp);
    }
}