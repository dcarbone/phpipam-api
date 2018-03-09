<?php namespace MyENA\PHPIPAMAPI\Models;

use DCarbone\Go\Time;
use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class VLAN
 * @package MyENA\PHPIPAMAPI\Models
 */
class VLAN extends AbstractModel {
    /** @var int|null */
    protected $vlanId = 0;
    /** @var int|null */
    protected $domainId = 0;
    /** @var string|null */
    protected $name = '';
    /** @var string|null */
    protected $description = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;

    /**
     * VLAN constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->editDate = $this->unmarshalDate($this->editDate);
    }

    /**
     * @return int|null
     */
    public function getVlanId(): ?int {
        return $this->vlanId;
    }

    /**
     * @return int|null
     */
    public function getDomainId(): ?int {
        return $this->domainId;
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
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getEditDate(): ?Time\Time {
        return $this->editDate;
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