<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostBase;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ByHostBase
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostBase
 */
class ByHostBase extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{hostbase}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters;

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
        if (!isset($this->parameters)) {
            $this->parameters = [
                (new Parameter('hostbase', Parameter::IN_ROUTE))
                    ->required()
                    ->addValidator(Parameter\Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Addresses\GET\SearchHostBase\ByHostBaseResponse|null
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
        return ByHostBaseResponse::fromPSR7Response($resp);
    }
}