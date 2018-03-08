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
    protected $realName = '';
    /** @var null|string */
    protected $email = '';
    /** @var null|bool */
    protected $pdns = false;
    /** @var null|bool */
    protected $editVlan = false;
    /** @var null|string */
    protected $ptsn = '';
    /** @var null|bool */
    protected $domainUser = false;
    /** @var null|string */
    protected $widgets = '';
    /** @var null|string */
    protected $lang = '';
    /** @var null|string */
    protected $favoriteSubnets = '';
    /** @var null|bool */
    protected $mailNotify = false;
    /** @var null|bool */
    protected $mailChangelog = false;
    /** @var null|bool */
    protected $passChange = false;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $editDate = null;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastLogin = null;
    /** @var \DCarbone\Go\Time\Time|null */
    protected $lastActivity = null;
    /** @var null|string */
    protected $compressOverride = '';
    /** @var null|bool */
    protected $hideFreeRange = false;
    /** @var null|string */
    protected $menuType = '';
    /** @var null|string */
    protected $token = '';
    /** @var \DCarbone\Go\Time\Time|null */
    protected $tokenValidUntil = null;

    /**
     * User constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->pdns = $this->parseBool($this->pdns);
        $this->editVlan = $this->parseBool($this->editVlan);
        $this->domainUser = $this->parseBool($this->domainUser);
        $this->mailNotify = $this->parseBool($this->mailNotify);
        $this->mailChangelog = $this->parseBool($this->mailChangelog);
        $this->passChange = $this->parseBool($this->passChange);
        $this->hideFreeRange = $this->parseBool($this->hideFreeRange);

        $this->editDate = $this->parseDate($this->editDate);
        $this->lastLogin = $this->parseDate($this->lastLogin);
        $this->lastActivity = $this->parseDate($this->lastActivity);
        $this->tokenValidUntil = $this->parseDate($this->tokenValidUntil);
    }

    /**
     * @return array
     */
    public function __debugInfo() {
        return $this->jsonSerialize();
    }

    /**
     * @return array
     */
    public function __sleep() {
        $keys = array_keys($this->jsonSerialize());
        unset($keys['password']);
        return $keys;
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
        return $this->realName;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @return bool|null
     */
    public function getPdns(): ?bool {
        return $this->pdns;
    }

    /**
     * @return bool|null
     */
    public function getEditVlan(): ?bool {
        return $this->editVlan;
    }

    /**
     * @return null|string
     */
    public function getPtsn(): ?string {
        return $this->ptsn;
    }

    /**
     * @return bool|null
     */
    public function getDomainUser(): ?bool {
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
        return $this->favoriteSubnets;
    }

    /**
     * @return bool|null
     */
    public function getMailNotify(): ?bool {
        return $this->mailNotify;
    }

    /**
     * @return bool|null
     */
    public function getMailChangelog(): ?bool {
        return $this->mailChangelog;
    }

    /**
     * @return bool|null
     */
    public function getPassChange(): ?bool {
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
     * @return bool|null
     */
    public function getHideFreeRange(): ?bool {
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
        return $this->tokenValidUntil;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = parent::jsonSerialize();
        $a['password'] = null;
        return $a;
    }
}