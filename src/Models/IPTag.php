<?php namespace MyENA\PHPIPAMAPI\Models;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class IPTags
 * @package MyENA\PHPIPAMAPI\Models
 */
class IPTag extends AbstractModel {
    /** @var int|null */
    protected $id = 0;
    /** @var string|null */
    protected $type = '';
    /** @var string|null */
    protected $showTag = '';
    /** @var string|null */
    protected $bgcolor = '';
    /** @var string|null */
    protected $fgcolor = '';
    /** @var string|null */
    protected $compress = '';
    /** @var string|null */
    protected $locked = '';
    /** @var int|null */
    protected $updateTag = 0;

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType(?string $type): void {
        $this->type = $type;
    }

    /**
     * @return null|string
     */
    public function getShowTag(): ?string {
        return $this->showTag;
    }

    /**
     * @param null|string $showTag
     */
    public function setShowTag(?string $showTag): void {
        $this->showTag = $showTag;
    }

    /**
     * @return null|string
     */
    public function getBgcolor(): ?string {
        return $this->bgcolor;
    }

    /**
     * @param null|string $bgcolor
     */
    public function setBgcolor(?string $bgcolor): void {
        $this->bgcolor = $bgcolor;
    }

    /**
     * @return null|string
     */
    public function getFgcolor(): ?string {
        return $this->fgcolor;
    }

    /**
     * @param null|string $fgcolor
     */
    public function setFgcolor(?string $fgcolor): void {
        $this->fgcolor = $fgcolor;
    }

    /**
     * @return null|string
     */
    public function getCompress(): ?string {
        return $this->compress;
    }

    /**
     * @param null|string $compress
     */
    public function setCompress(?string $compress): void {
        $this->compress = $compress;
    }

    /**
     * @return null|string
     */
    public function getLocked(): ?string {
        return $this->locked;
    }

    /**
     * @param null|string $locked
     */
    public function setLocked(?string $locked): void {
        $this->locked = $locked;
    }

    /**
     * @return int|null
     */
    public function getUpdateTag(): ?int {
        return $this->updateTag;
    }

    /**
     * @param int|null $updateTag
     */
    public function setUpdateTag(?int $updateTag): void {
        $this->updateTag = $updateTag;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}