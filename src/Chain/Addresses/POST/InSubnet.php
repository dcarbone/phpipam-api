<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\POST;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;

/**
 * Class InSubnet
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\POST
 */
class InSubnet extends AbstractPart implements ParamPart, ExecutablePart {
    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters;

    /**
     * @return \MyENA\PHPIPAMAPI\Parameter[]
     */
    public function getParameters(): array {
        if (!isset($this->parameters)) {
            $this->parameters = [
                (new Parameter('ip', Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Parameter\Validators::String())
                    ->addValidator(Parameter\Validators::IPv4()),
                (new Parameter('subnetId', Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Parameter\Validators::Integer()),
                (new Parameter('mac', Parameter::IN_QUERY))
                    ->addValidator(Parameter\Validators::MAC()),
                (new Parameter('switch', Parameter::IN_QUERY))
                    ->addValidator(Parameter\Validators::Integer()),
                (new Parameter('state', Parameter::IN_QUERY))
                    ->addValidator(Parameter\Validators::Integer()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\POST\InSubnetResponse|null
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
        return InSubnetResponse::fromPSR7Response($resp, $this->logger);
    }
}