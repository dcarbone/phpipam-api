<?php namespace MyENA\PHPIPAMAPI\Models;

use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class IPAddressPing
 * @package MyENA\PHPIPAMAPI\Models
 */
class IPAddressPing extends AbstractModel {
    /** @var string|null */
    protected $scan_type = '';
    /** @var int|null */
    protected $exit_code = 0;
    /** @var string|null */
    protected $result_code = '';
    /** @var string|null */
    protected $message = '';

    /**
     * @return null|string
     */
    public function getScanType(): ?string {
        return $this->scan_type;
    }

    /**
     * @return int|null
     */
    public function getExitCode(): ?int {
        return $this->exit_code;
    }

    /**
     * @return null|string
     */
    public function getResultCode(): ?string {
        return $this->result_code;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string {
        return $this->message;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}