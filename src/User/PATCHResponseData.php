<?php namespace MyENA\PHPIPAMAPI\User;

use DCarbone\Go\Time;
use MyENA\PHPIPAMAPI\AbstractModel;

/**
 * Class PATCHResponseData
 * @package MyENA\PHPIPAMAPI\User
 */
class PATCHResponseData extends AbstractModel {

    /** @var string */
    protected $expires = '';

    /** @var \DCarbone\Go\Time\Time */
    private $time;

    /**
     * @return string
     */
    public function getExpires(): string {
        return $this->expires;
    }

    /**
     * @return \DCarbone\Go\Time\Time
     */
    public function getExpiresTime(): Time\Time {
        if (!isset($this->time) || (isset($this->time) && $this->time->IsZero() && '' !== $this->expires)) {
            if ('' === $this->expires) {
                $this->time = Time::New();
            } else {
                try {
                    $this->time = Time\Time::createFromFormat(PHPIPAM_TOKEN_EXPIRES_FORMAT, $this->expires);
                } catch (\Throwable $e) {
                    throw new \DomainException(sprintf(
                        'Expires not in expected format of "%s": %s',
                        PHPIPAM_TOKEN_EXPIRES_FORMAT,
                        $this->expires
                    ));
                }
            }
        }
        return $this->time;
    }
}