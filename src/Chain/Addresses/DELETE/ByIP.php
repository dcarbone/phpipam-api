<?php namespace MyENA\PHPIPAMAPI\Chain\Addresses\DELETE;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP\InSubnet;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ByIP
 * @package MyENA\PHPIPAMAPI\Chain\Addresses\DELETE
 */
class ByIP extends AbstractPart implements UriPart, ParamPart {
    const PATH = '{ip}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters;

    /**
     * @param int $subnetId
     * @return \MyENA\PHPIPAMAPI\Chain\Addresses\DELETE\ByIP\InSubnet
     */
    public function InSubnet(int $subnetId): InSubnet {
        return $this->newPart(InSubnet::class, ['subnetId' => $subnetId]);
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
                (new Parameter('ip', Parameter::IN_ROUTE))
                    ->required()
                    ->addValidator(Parameter\Validators::IPv4()),
            ];
        }
        return $this->parameters;
    }
}