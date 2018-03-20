<?php namespace MyENA\PHPIPAMAPI\Models\Subnet;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class Calculation
 * @package MyENA\PHPIPAMAPI\Models\Subnet
 */
class Calculation extends AbstractModel {
    /** @var string|null */
    protected $Type = '';
    /** @var string|null */
    protected $IP_address = '';
    /** @var string|null */
    protected $Network = '';
    /** @var string|null */
    protected $Broadcast = '';
    /** @var string|null */
    protected $Subnet_bitmask = '';
    /** @var string|null */
    protected $Subnet_netmask = '';
    /** @var string|null */
    protected $Subnet_wildcard = '';
    /** @var string|null */
    protected $Min_host_IP = '';
    /** @var string|null */
    protected $Max_host_IP = '';
    /** @var int|null */
    protected $Number_of_hosts = 0;
    /** @var string|null */
    protected $Subnet_Class = '';

    /**
     * @return null|string
     */
    public function getType(): ?string {
        return $this->Type;
    }

    /**
     * @return null|string
     */
    public function getIPAddress(): ?string {
        return $this->IP_address;
    }

    /**
     * @return null|string
     */
    public function getNetwork(): ?string {
        return $this->Network;
    }

    /**
     * @return null|string
     */
    public function getBroadcast(): ?string {
        return $this->Broadcast;
    }

    /**
     * @return null|string
     */
    public function getSubnetBitmask(): ?string {
        return $this->Subnet_bitmask;
    }

    /**
     * @return null|string
     */
    public function getSubnetNetmask(): ?string {
        return $this->Subnet_netmask;
    }

    /**
     * @return null|string
     */
    public function getSubnetWildcard(): ?string {
        return $this->Subnet_wildcard;
    }

    /**
     * @return null|string
     */
    public function getMinHostIP(): ?string {
        return $this->Min_host_IP;
    }

    /**
     * @return null|string
     */
    public function getMaxHostIP(): ?string {
        return $this->Max_host_IP;
    }

    /**
     * @return int|null
     */
    public function getNumberOfHosts(): ?int {
        return $this->Number_of_hosts;
    }

    /**
     * @return null|string
     */
    public function getSubnetClass(): ?string {
        return $this->Subnet_Class;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}