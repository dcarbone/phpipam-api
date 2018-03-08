<?php namespace MyENA\PHPIPAMAPI;

use DCarbone\Go\Time;

/**
 * Class AbstractModel
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractModel implements \JsonSerializable {
    /**
     * AbstractModel constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        foreach ($data as $k => $v) {
            $this->{$k} = $v;
        }
    }

    /**
     * @param \DCarbone\Go\Time\Time|null $time
     * @return null|string
     */
    protected function marshalDate(?Time\Time $time): ?string {
        if (null === $time || $time->IsZero()) {
            return null;
        } else {
            return $time->format(PHPIPAM_DATETIME_FORMAT);
        }
    }

    /**
     * @param null|string $input
     * @return \DCarbone\Go\Time\Time
     */
    protected function unmarshalDate(?string $input): Time\Time {
        if (null === $input) {
            return Time::New();
        } else {
            try {
                return Time\Time::createFromFormat(PHPIPAM_DATETIME_FORMAT, $input);
            } catch (\Exception $e) {
                throw new \DomainException(sprintf(
                    'Expected Date format "%s", saw: %s',
                    PHPIPAM_DATETIME_FORMAT,
                    $input
                ));
            }
        }
    }
}