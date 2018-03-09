<?php namespace MyENA\PHPIPAMAPI\Models;

use DCarbone\Go\Time;
use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class Section
 * @package MyENA\PHPIPAMAPI\Models
 */
class Section extends AbstractModel {
    /** @var int|null */
    protected $id = 0;
    /** @var string|null */
    protected $name = '';
    /** @var string|null */
    protected $description = '';
    /** @var int|null */
    protected $masterSection = 0;
    /** @var string|null */
    protected $permissions = '';
    /** @var string|null */
    protected $strictMode = '';
    /** @var string|null */
    protected $subnetOrdering = '';
    /** @var int|null */
    protected $order = 0;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;
    /** @var int|null */
    protected $showVLAN = 0;
    /** @var int|null */
    protected $showVRF = 0;
    /** @var int|null */
    protected $showSupernetOnly = 0;
    /** @var string|null */
    protected $DNS = '';

    /**
     * Section constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->editDate = $this->unmarshalDate($this->editDate);
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
    public function getName(): ?string {
        return $this->name;
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
    public function getMasterSection(): ?int {
        return $this->masterSection;
    }

    /**
     * @return null|string
     */
    public function getPermissions(): ?string {
        return $this->permissions;
    }

    /**
     * @return null|string
     */
    public function getStrictMode(): ?string {
        return $this->strictMode;
    }

    /**
     * @return null|string
     */
    public function getSubnetOrdering(): ?string {
        return $this->subnetOrdering;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int {
        return $this->order;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getEditDate(): ?Time\Time {
        return $this->editDate;
    }

    /**
     * @return int|null
     */
    public function getShowVLAN(): ?int {
        return $this->showVLAN;
    }

    /**
     * @return int|null
     */
    public function getShowVRF(): ?int {
        return $this->showVRF;
    }

    /**
     * @return int|null
     */
    public function getShowSupernetOnly(): ?int {
        return $this->showSupernetOnly;
    }

    /**
     * @return null|string
     */
    public function getDNS(): ?string {
        return $this->DNS;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = get_object_vars($this);
        $a['editDate'] = $this->marshalDate($this->editDate);
        return $a;
    }
}