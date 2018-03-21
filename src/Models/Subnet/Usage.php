<?php namespace MyENA\PHPIPAMAPI\Models\Subnet;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class Usage
 * @package MyENA\PHPIPAMAPI\Models\Subnet
 */
class Usage extends AbstractModel {
    /** @var int|null */
    protected $used = 0;
    /** @var int|null */
    protected $maxhosts = 0;
    /** @var int|null */
    protected $freehosts = 0;
    /** @var float|null */
    protected $freehosts_percent = 0.0;
    /** @var float|null */
    protected $Offline_percent = 0.0;
    /** @var float|null */
    protected $Used_percent = 0.0;
    /** @var float|null */
    protected $Reserved_percent = 0.0;
    /** @var float|null */
    protected $DHCP_percent = 0.0;

    /**
     * @return int|null
     */
    public function getUsed(): ?int {
        return $this->used;
    }

    /**
     * @return int|null
     */
    public function getMaxhosts(): ?int {
        return $this->maxhosts;
    }

    /**
     * @return int|null
     */
    public function getFreehosts(): ?int {
        return $this->freehosts;
    }

    /**
     * @return float|null
     */
    public function getFreehostsPercent(): ?float {
        return $this->freehosts_percent;
    }

    /**
     * @return float|null
     */
    public function getOfflinePercent(): ?float {
        return $this->Offline_percent;
    }

    /**
     * @return float|null
     */
    public function getUsedPercent(): ?float {
        return $this->Used_percent;
    }

    /**
     * @return float|null
     */
    public function getReservedPercent(): ?float {
        return $this->Reserved_percent;
    }

    /**
     * @return float|null
     */
    public function getDHCPPercent(): ?float {
        return $this->DHCP_percent;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
