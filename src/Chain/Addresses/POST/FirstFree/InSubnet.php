<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class InSubnet
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\POST\FirstFree
 */
class InSubnet extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{subnetId}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters = [];

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
                ->addValidator(Parameter\Validators::Integer())
            ];
        }
        return $this->parameters;
    }

    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\PHPIPAMAPI\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        var_dump($resp->getBody()->getContents());exit;
        exit;
    }
}