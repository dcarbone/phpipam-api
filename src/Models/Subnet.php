<?php namespace MyENA\PHPIPAMAPI\Models;
use DCarbone\Go\Time;
use MyENA\PHPIPAMAPI\Models\Subnet\Calculation;

/**
 * Class Subnet
 * @package MyENA\PHPIPAMAPI\Models
 */
class Subnet extends AbstractModelWithCustomFields {
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
    protected $DNSrecords = 0;
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
    /** @var string|null */
    protected $masterSubnetId = '';
    /** @var string|null */
    protected $allowRequests = '';
    /** @var string|null */
    protected $vlanId = '';
    /** @var string|null */
    protected $tag = '';
    /** @var \MyENA\PHPIPAMAPI\Models\Subnet\Calculation|null */
    protected $calculation = null;

    /**
     * Subnet constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->editDate = $this->unmarshalDate($this->editDate);
        $this->lastScan = $this->unmarshalDate($this->lastScan);
        $this->lastDiscovery = $this->unmarshalDate($this->lastDiscovery);
        if (isset($this->calculation)) {
            $this->calculation = new Calculation($this->calculation);
        }
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
    public function getDNSrecords(): ?int {
        return $this->DNSrecords;
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
    public function getEditDate(): ?Time\Time {
        return $this->editDate;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getLastScan(): ?Time\Time {
        return $this->lastScan;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getLastDiscovery(): ?Time\Time {
        return $this->lastDiscovery;
    }

    /**
     * @return null|string
     */
    public function getMasterSubnetId(): ?string {
        return $this->masterSubnetId;
    }

    /**
     * @return null|string
     */
    public function getAllowRequests(): ?string {
        return $this->allowRequests;
    }

    /**
     * @return null|string
     */
    public function getVlanId(): ?string {
        return $this->vlanId;
    }

    /**
     * @return null|string
     */
    public function getTag(): ?string {
        return $this->tag;
    }

    /**
     * @return \MyENA\PHPIPAMAPI\Models\Subnet\Calculation|null
     */
    public function getCalculation(): ?Subnet\Calculation {
        return $this->calculation;
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