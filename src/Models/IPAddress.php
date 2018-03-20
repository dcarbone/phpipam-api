<?php namespace MyENA\PHPIPAMAPI\Models;

use DCarbone\Go\Time;

/**
 * Class IPAddress
 * @package MyENA\PHPIPAMAPI\Models
 */
class IPAddress extends AbstractModelWithCustomFields {
    /** @var int|null */
    protected $id = 0;
    /** @var int|null */
    protected $subnetId = 0;
    /** @var string|null */
    protected $ip_addr = '';
    /** @var int|null */
    protected $is_gateway = 0;
    /** @var string|null */
    protected $description = '';
    /** @var string|null */
    protected $hostname = '';
    /** @var string|null */
    protected $mac = '';
    /** @var string|null */
    protected $owner = '';
    /** @var int|null */
    protected $state = 0;
    /** @var int|null */
    protected $switch = 0;
    /** @var int|null */
    protected $location = 0;
    /** @var int|null */
    protected $port = 0;
    /** @var string|null */
    protected $note = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastSeen = null;
    /** @var int|null */
    protected $excludePing = 0;
    /** @var int|null */
    protected $PTRignore = 0;
    /** @var int|null */
    protected $PTR = 0;
    /** @var string|null */
    protected $firewallAddressObject = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;
    /** @var string|null */
    protected $ip = '';
    /** @var string|null */
    protected $tag = '';
    /** @var string|null */
    protected $deviceId = '';

    /**
     * IPAddress constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->lastSeen = $this->unmarshalDate($this->lastSeen);
        $this->editDate = $this->unmarshalDate($this->editDate);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getSubnetId(): ?int {
        return $this->subnetId;
    }

    /**
     * @return null|string
     */
    public function getIpAddr(): ?string {
        return $this->ip_addr;
    }

    /**
     * @return int|null
     */
    public function getisGateway(): ?int {
        return $this->is_gateway;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @return null|string
     */
    public function getHostname(): ?string {
        return $this->hostname;
    }

    /**
     * @return null|string
     */
    public function getMac(): ?string {
        return $this->mac;
    }

    /**
     * @return null|string
     */
    public function getOwner(): ?string {
        return $this->owner;
    }

    /**
     * @return int|null
     */
    public function getState(): ?int {
        return $this->state;
    }

    /**
     * @return int|null
     */
    public function getSwitch(): ?int {
        return $this->switch;
    }

    /**
     * @return int|null
     */
    public function getLocation(): ?int {
        return $this->location;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int {
        return $this->port;
    }

    /**
     * @return null|string
     */
    public function getNote(): ?string {
        return $this->note;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getLastSeen(): ?Time\Time {
        return $this->lastSeen;
    }

    /**
     * @return int|null
     */
    public function getExcludePing(): ?int {
        return $this->excludePing;
    }

    /**
     * @return int|null
     */
    public function getPTRignore(): ?int {
        return $this->PTRignore;
    }

    /**
     * @return int|null
     */
    public function getPTR(): ?int {
        return $this->PTR;
    }

    /**
     * @return null|string
     */
    public function getFirewallAddressObject(): ?string {
        return $this->firewallAddressObject;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getEditDate(): ?Time\Time {
        return $this->editDate;
    }

    /**
     * @return null|string
     */
    public function getIp(): ?string {
        return $this->ip;
    }

    /**
     * @return null|string
     */
    public function getTag(): ?string {
        return $this->tag;
    }

    /**
     * @return null|string
     */
    public function getDeviceId(): ?string {
        return $this->deviceId;
    }
    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = get_object_vars($this);
        $a['lastSeen'] = $this->marshalDate($this->lastSeen);
        $a['editDate'] = $this->marshalDate($this->editDate);
        return $a;
    }
}