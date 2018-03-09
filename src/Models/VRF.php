<?php namespace MyENA\PHPIPAMAPI\Models;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class VRF
 * @package MyENA\PHPIPAMAPI\Models
 */
class VRF extends AbstractModel {
    /** @var int|null */
    protected $vrfId = 0;
    /** @var string|null */
    protected $name = '';
    /** @var string|null */
    protected $rd = '';
    /** @var string|null */
    protected $descriptions = '';
    /** @var string|null */
    protected $sections = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;

    /**
     * VRF constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->editDate = $this->unmarshalDate($this->editDate);
    }

    /**
     * @return int|null
     */
    public function getVrfId(): ?int {
        return $this->vrfId;
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
    public function getRd(): ?string {
        return $this->rd;
    }

    /**
     * @return null|string
     */
    public function getDescriptions(): ?string {
        return $this->descriptions;
    }

    /**
     * @return null|string
     */
    public function getSections(): ?string {
        return $this->sections;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getEditDate(): ?\DCarbone\Go\Time\Time {
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