<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Client;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ByIPAddress
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search
 */
class ByIPAddress extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{ip_address}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters = [];

    /**
     * ByIPAddress constructor.
     * @param \MyENA\PHPIPAMAPI\Client $client
     * @param \MyENA\PHPIPAMAPI\AbstractPart[] ...$parents
     */
    public function __construct(Client $client, AbstractPart ...$parents) {
        parent::__construct($client, ...$parents);
        $this->parameters = [
            (new Parameter('ip_address', Parameter::IN_ROUTE))
                ->required()
                ->addValidator(Parameter\Validators::String())
                ->addValidator(Parameter\Validators::IPv4()),
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
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\GET\Search\ByIPAddressResponse|null
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
        return ByIPAddressResponse::fromPSR7Response($resp);
    }
}