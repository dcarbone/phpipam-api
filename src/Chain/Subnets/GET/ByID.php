<?php namespace MyENA\PHPIPAMAPI\Chain\Subnets\GET;

use MyENA\PHPIPAMAPI\AbstractPart;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Addresses;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AllSubnets;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstFree;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstSubnet;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Search;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Slaves;
use MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Usage;
use MyENA\PHPIPAMAPI\Parameter;
use MyENA\PHPIPAMAPI\Part\ExecutablePart;
use MyENA\PHPIPAMAPI\Part\ParamPart;
use MyENA\PHPIPAMAPI\Part\UriPart;

/**
 * Class ByID
 * @package MyENA\PHPIPAMAPI\Chain\Subnets\GET
 */
class ByID extends AbstractPart implements UriPart, ParamPart, ExecutablePart {
    const PATH = '{id}/';

    /** @var \MyENA\PHPIPAMAPI\Parameter[] */
    private $parameters;

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Addresses
     */
    public function Addresses(): Addresses {
        return $this->newPart(Addresses::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\AllSubnets
     */
    public function AllSubnets(): AllSubnets {
        return $this->newPart(AllSubnets::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstFree
     */
    public function FirstFree(): FirstFree {
        return $this->newPart(FirstFree::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\FirstSubnet
     */
    public function FirstSubnet(): FirstSubnet {
        return $this->newPart(FirstSubnet::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Search
     */
    public function Search(): Search {
        return $this->newPart(Search::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Slaves
     */
    public function Slaves(): Slaves {
        return $this->newPart(Slaves::class);
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByID\Usage
     */
    public function Usage(): Usage {
        return $this->newPart(Usage::class);
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
                    ->addValidator(Parameter\Validators::Integer()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\PHPIPAMAPI\Chain\Subnets\GET\ByIDResponse|null
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
        return ByIDResponse::fromPSR7Response($resp, $this->logger);
    }
}