<?php namespace MyENA\PHPIPAMAPI\Models;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class Subnet
 * @package MyENA\PHPIPAMAPI\Models
 */
class Subnet extends AbstractModel {
    /** @var int|null */
    protected $id = 0;
    /** @var string|null */
    protected $subnet = '';
    /** @var string|null */
    protected $mask = '';
    /** @var int|null */
    protected $sectionId = 0;
    /** @var string|null */
    protected $description = '';
    /** @var int|null */
    protected $linked_subnet = 0;
    /** @var string|null */
    protected $firewallAddressObject = '';
    /** @var int|null */
    protected $vrfId = 0;
    /** @var int|null */
    protected $showName = 0;
    /** @var int|null */
    protected $device = 0;
    /** @var string|null */
    protected $permissions = '';
    /** @var int|null */
    protected $pingSubnet = 0;
    /** @var int|null */
    protected $discoverSubnet = 0;
    /** @var int|null */
    protected $resolveDNS = 0;
    /** @var int|null */
    protected $DNSrecursive = 0;
    /** @var int|null */
    protected $DNSrescords = 0;
    /** @var int|null */
    protected $nameserverId = 0;
    /** @var int|null */
    protected $scanAgent = 0;
    /** @var int|null */
    protected $isFolder = 0;
    /** @var int|null */
    protected $isFull = 0;
    /** @var int|null */
    protected $state = 0;
    /** @var int|null */
    protected $threshold = 0;
    /** @var int|null */
    protected $location = 0;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastScan = null;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastDiscovery = null;

    /**
     * Subnet constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->editDate = $this->unmarshalDate($this->editDate);
        $this->lastScan = $this->unmarshalDate($this->lastScan);
        $this->lastDiscovery = $this->unmarshalDate($this->lastDiscovery);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getSubnet(): ?string {
        return $this->subnet;
    }

    /**
     * @return null|string
     */
    public function getMask(): ?string {
        return $this->mask;
    }

    /**
     * @return int|null
     */
    public function getSectionId(): ?int {
        return $this->sectionId;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getLinkedSubnet(): ?int {
        return $this->linked_subnet;
    }

    /**
     * @return null|string
     */
    public function getFirewallAddressObject(): ?string {
        return $this->firewallAddressObject;
    }

    /**
     * @return int|null
     */
    public function getVrfId(): ?int {
        return $this->vrfId;
    }

    /**
     * @return int|null
     */
    public function getShowName(): ?int {
        return $this->showName;
    }

    /**
     * @return int|null
     */
    public function getDevice(): ?int {
        return $this->device;
    }

    /**
     * @return null|string
     */
    public function getPermissions(): ?string {
        return $this->permissions;
    }

    /**
     * @return int|null
     */
    public function getPingSubnet(): ?int {
        return $this->pingSubnet;
    }

    /**
     * @return int|null
     */
    public function getDiscoverSubnet(): ?int {
        return $this->discoverSubnet;
    }

    /**
     * @return int|null
     */
    public function getResolveDNS(): ?int {
        return $this->resolveDNS;
    }

    /**
     * @return int|null
     */
    public function getDNSrecursive(): ?int {
        return $this->DNSrecursive;
    }

    /**
     * @return int|null
     */
    public function getDNSrescords(): ?int {
        return $this->DNSrescords;
    }

    /**
     * @return int|null
     */
    public function getNameserverId(): ?int {
        return $this->nameserverId;
    }

    /**
     * @return int|null
     */
    public function getScanAgent(): ?int {
        return $this->scanAgent;
    }

    /**
     * @return int|null
     */
    public function getIsFolder(): ?int {
        return $this->isFolder;
    }

    /**
     * @return int|null
     */
    public function getIsFull(): ?int {
        return $this->isFull;
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
    public function getThreshold(): ?int {
        return $this->threshold;
    }

    /**
     * @return int|null
     */
    public function getLocation(): ?int {
        return $this->location;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getEditDate(): ?\DCarbone\Go\Time\Time {
        return $this->editDate;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getLastScan(): ?\DCarbone\Go\Time\Time {
        return $this->lastScan;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getLastDiscovery(): ?\DCarbone\Go\Time\Time {
        return $this->lastDiscovery;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = get_object_vars($this);
        $a['editDate'] = $this->marshalDate($this->editDate);
        $a['lastScan'] = $this->marshalDate($this->lastScan);
        $a['lastDiscovery'] = $this->marshalDate($this->lastDiscovery);
        return $a;
    }
}