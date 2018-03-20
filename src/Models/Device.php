<?php namespace MyENA\PHPIPAMAPI\Models;

use DCarbone\Go\Time;

/**
 * Class Device
 * @package MyENA\PHPIPAMAPI\Models
 */
class Device extends AbstractModelWithCustomFields {
    /** @var int|null */
    protected $id = 0;
    /** @var string|null */
    protected $hostname = '';
    /** @var string|null */
    protected $ip_addr = '';
    /** @var int|null */
    protected $type = 0;
    /** @var string|null */
    protected $description = '';
    /** @var string|null */
    protected $sections = '';
    /** @var string|null */
    protected $snmp_community = '';
    /** @var int|null */
    protected $snmp_version = 0;
    /** @var int|null */
    protected $snmp_port = 0;
    /** @var int|null */
    protected $snmp_timeout = 0;
    /** @var string|null */
    protected $snmp_queries = '';
    /** @var string|null */
    protected $snmp_v3_sec_level = '';
    /** @var string|null */
    protected $snmp_v3_auth_protocol = '';
    /** @var string|null */
    protected $snmp_v3_auth_pass = '';
    /** @var string|null */
    protected $snmp_v3_priv_protocol = '';
    /** @var string|null */
    protected $snmp_v3_priv_pass = '';
    /** @var string|null */
    protected $snmp_v3_ctx_name = '';
    /** @var string|null */
    protected $snmp_v3_ctx_engine_id = '';
    /** @var int|null */
    protected $rack = 0;
    /** @var int|null */
    protected $rack_start = 0;
    /** @var int|null */
    protected $rack_end = 0;
    /** @var int|null */
    protected $location = 0;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;

    /**
     * Device constructor.
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
    public function getHostname(): ?string {
        return $this->hostname;
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
    public function getType(): ?int {
        return $this->type;
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
    public function getSections(): ?string {
        return $this->sections;
    }

    /**
     * @return null|string
     */
    public function getSnmpCommunity(): ?string {
        return $this->snmp_community;
    }

    /**
     * @return int|null
     */
    public function getSnmpVersion(): ?int {
        return $this->snmp_version;
    }

    /**
     * @return int|null
     */
    public function getSnmpPort(): ?int {
        return $this->snmp_port;
    }

    /**
     * @return int|null
     */
    public function getSnmpTimeout(): ?int {
        return $this->snmp_timeout;
    }

    /**
     * @return null|string
     */
    public function getSnmpQueries(): ?string {
        return $this->snmp_queries;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3SecLevel(): ?string {
        return $this->snmp_v3_sec_level;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3AuthProtocol(): ?string {
        return $this->snmp_v3_auth_protocol;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3AuthPass(): ?string {
        return $this->snmp_v3_auth_pass;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3PrivProtocol(): ?string {
        return $this->snmp_v3_priv_protocol;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3PrivPass(): ?string {
        return $this->snmp_v3_priv_pass;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3CtxName(): ?string {
        return $this->snmp_v3_ctx_name;
    }

    /**
     * @return null|string
     */
    public function getSnmpV3CtxEngineId(): ?string {
        return $this->snmp_v3_ctx_engine_id;
    }

    /**
     * @return int|null
     */
    public function getRack(): ?int {
        return $this->rack;
    }

    /**
     * @return int|null
     */
    public function getRackStart(): ?int {
        return $this->rack_start;
    }

    /**
     * @return int|null
     */
    public function getRackEnd(): ?int {
        return $this->rack_end;
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
     * @return array
     */
    public function jsonSerialize() {
        $a = get_object_vars($this);
        $a['editDate'] = $this->marshalDate($this->editDate);
        return $a;
    }
}