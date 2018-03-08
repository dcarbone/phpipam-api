<?php namespace MyENA\PHPIPAMAPI;

use DCarbone\Go\Time;

/**
 * Class AbstractModel
 * @package MyENA\PHPIPAMAPI
 */
abstract class AbstractModel implements \JsonSerializable {
    private $keys = [];

    /**
     * AbstractModel constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        foreach ($data as $k => $v) {
            $this->{$k} = $v;
            $this->keys[] = $k;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = [];
        foreach ($this->keys as $key) {
            $a[$key] = $this->{$key};
        }
        return $a;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    protected function parseBool($input): bool {
        $type = gettype($input);
        if ('string' === $type) {
            return 'Yes' === $input || '1' === $input;
        } else if ('integer' === $type) {
            return 0 !== $input;
        } else if ('double' === $type) {
            return 0 != $input;
        }
        return false;
    }

    /**
     * @param null|string $input
     * @return \DCarbone\Go\Time\Time
     */
    protected function parseDate(?string $input): Time\Time {
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