<?php namespace ENA\PHPIPAMAPI\User;

use DCarbone\Go\Time;
use ENA\PHPIPAMAPI\AbstractModel;

/**
 * Class POSTResponseData
 * @package ENA\PHPIPAMAPI\User
 */
class POSTResponseData extends AbstractModel {
    const EXPIRES_FORMAT = 'Y-m-d H:i:s';

    /** @var string */
    protected $token = '';
    /** @var string */
    protected $expires = '';

    /** @var \DCarbone\Go\Time\Time */
    private $time;

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

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
        if (!isset($this->time)) {
            if ('' === $this->expires) {
                $this->time = Time::New();
            } else {
                try {
                    $this->time = Time\Time::createFromFormat(self::EXPIRES_FORMAT, $this->expires);
                } catch (\Throwable $e) {
                    throw new \DomainException(sprintf(
                        'Expires not in expected format of "%s": %s',
                        self::EXPIRES_FORMAT,
                        $this->expires
                    ));
                }
            }
        }
        return $this->time;
    }
}