<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags\ByID\Addresses;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ByID
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags
 */
class ByID extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{id}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters;

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags\ByID\Addresses
     */
    public function Addresses(): Addresses {
        return $this->newPart(Addresses::class);
    }

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
                (new Parameter('id', Parameter::IN_ROUTE))
                ->required()
                ->addValidator(Parameter\Validators::Integer())
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\GET\Tags\ByIDResponse|null
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
        return ByIDResponse::fromPSR7Response($resp);
    }
}