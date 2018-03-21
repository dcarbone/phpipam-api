<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET\CIDR;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class BySubnet
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET\CIDR
 */
class BySubnet extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{subnet}/';

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
                (new Parameter('subnet', Parameter::IN_ROUTE))
                ->required()
                ->addValidator(Parameter\Validators::String())
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Subnets\GET\CIDR\BySubnetResponse|null
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
        return BySubnetResponse::fromPSR7Response($resp, $this->logger);
    }
}