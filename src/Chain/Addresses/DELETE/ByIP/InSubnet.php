<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class InSubnet
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP
 */
class InSubnet extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{subnetId}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters;

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Parameter[]
     */
    public function getParameters(): array {
        if (!isset($this->parameters)) {
            $this->parameters = [
                (new Parameter('subnetId', Parameter::IN_ROUTE))
                    ->required()
                    ->addValidator(Parameter\Validators::Integer()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP\InSubnetResponse|null
     * @type \MyENA\PHPIPAMAPI\Parameter|null
     * )
     */
    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        return InSubnetResponse::fromPSR7Response($resp, $this->logger);
    }
}