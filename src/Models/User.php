<?php namespace MyENA\PHPIPAMAPI\Models;

use DCarbone\Go\Time;
use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class User
 * @package MyENA\PHPIPAMAPI\Models
 */
class User extends AbstractModel {
    /** @var null|int */
    protected $id = 0;
    /** @var null|string */
    protected $username = '';
    /** @var null|int */
    protected $authMethod = 0;
    /** @var null|string */
    protected $password = '';
    /** @var null|string */
    protected $groups = '';
    /** @var null|string */
    protected $role = '';
    /** @var null|string */
    protected $real_name = '';
    /** @var null|string */
    protected $email = '';
    /** @var null|string */
    protected $pdns = '';
    /** @var null|string */
    protected $editVlan = '';
    /** @var null|string */
    protected $editCircuits = '';
    /** @var null|string */
    protected $ptsn = '';
    /** @var null|string */
    protected $domainUser = '';
    /** @var null|string */
    protected $widgets = '';
    /** @var null|string */
    protected $lang = '';
    /** @var null|string */
    protected $favorite_subnets = '';
    /** @var null|string */
    protected $mailNotify = '';
    /** @var null|string */
    protected $mailChangelog = '';
    /** @var null|'' */
    protected $passChange = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastLogin = null;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastActivity = null;
    /** @var null|string */
    protected $compressOverride = '';
    /** @var null|string */
    protected $hideFreeRange = '';
    /** @var null|string */
    protected $menuType = '';
    /** @var null|string */
    protected $token = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $token_valid_until = null;

    /**
     * User constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->editDate = $this->unmarshalDate($this->editDate);
        $this->lastLogin = $this->unmarshalDate($this->lastLogin);
        $this->lastActivity = $this->unmarshalDate($this->lastActivity);
        $this->token_valid_until = $this->unmarshalDate($this->token_valid_until);
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
    public function getUsername(): ?string {
        return $this->username;
    }

    /**
     * @return int|null
     */
    public function getAuthMethod(): ?int {
        return $this->authMethod;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getGroups(): ?string {
        return $this->groups;
    }

    /**
     * @return null|string
     */
    public function getRole(): ?string {
        return $this->role;
    }

    /**
     * @return null|string
     */
    public function getRealName(): ?string {
        return $this->real_name;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getPdns(): ?string {
        return $this->pdns;
    }

    /**
     * @return null|string
     */
    public function getEditVlan(): ?string {
        return $this->editVlan;
    }

    /**
     * @return null|string
     */
    public function getEditCircuits(): ?string {
        return $this->editCircuits;
    }

    /**
     * @return null|string
     */
    public function getPtsn(): ?string {
        return $this->ptsn;
    }

    /**
     * @return null|string
     */
    public function getDomainUser(): ?string {
        return $this->domainUser;
    }

    /**
     * @return null|string
     */
    public function getWidgets(): ?string {
        return $this->widgets;
    }

    /**
     * @return null|string
     */
    public function getLang(): ?string {
        return $this->lang;
    }

    /**
     * @return null|string
     */
    public function getFavoriteSubnets(): ?string {
        return $this->favorite_subnets;
    }

    /**
     * @return null|string
     */
    public function getMailNotify(): ?string {
        return $this->mailNotify;
    }

    /**
     * @return null|string
     */
    public function getMailChangelog(): ?string {
        return $this->mailChangelog;
    }

    /**
     * @return null
     */
    public function getPassChange() {
        return $this->passChange;
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
    public function getLastLogin(): ?Time\Time {
        return $this->lastLogin;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getLastActivity(): ?Time\Time {
        return $this->lastActivity;
    }

    /**
     * @return null|string
     */
    public function getCompressOverride(): ?string {
        return $this->compressOverride;
    }

    /**
     * @return null|string
     */
    public function getHideFreeRange(): ?string {
        return $this->hideFreeRange;
    }

    /**
     * @return null|string
     */
    public function getMenuType(): ?string {
        return $this->menuType;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string {
        return $this->token;
    }

    /**
     * @return \DCarbone\Go\Time\Time|null
     */
    public function getTokenValidUntil(): ?Time\Time {
        return $this->token_valid_until;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = get_object_vars($this);
        $a['editDate'] = $this->marshalDate($this->editDate);
        $a['lastLogin'] = $this->marshalDate($this->lastLogin);
        $a['lastActivity'] = $this->marshalDate($this->lastActivity);
        $a['token_valid_until'] = $this->marshalDate($this->token_valid_until);
        return $a;
    }
}