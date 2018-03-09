<?php namespace MyENA\PHPIPAMAPI;

use MyENA\PHPIPAMAPI\Parameter\Validator;

/**
 * Class Parameter
 * @package MyENA\PHPIPAMAPI
 */
class Parameter {
    const IN_ROUTE = 'route';
    const IN_QUERY = 'query';

    /** @var string */
    protected $name = '';
    /** @var mixed */
    protected $value;

    /** @var string */
    protected $location;

    /** @var mixed */
    protected $default;

    /** @var \MyENA\PHPIPAMAPI\Parameter\Validator[] */
    protected $validators = [];

    /** @var \MyENA\PHPIPAMAPI\Parameter\Validator|null */
    protected $lastFailedValidator = null;
    /** @var \MyENA\PHPIPAMAPI\Parameter\Validator[] */
    protected $failedValidations = [];

    /**
     * Argument constructor.
     * @param string $name Name of parameter (must align with slug if route param)
     * @param string $location Location of parameter
     */
    public function __construct(string $name, string $location) {
        if ('' === ($name = trim($name))) {
            throw new \InvalidArgumentException('name cannot be empty');
        }
        if ($location !== self::IN_ROUTE && $location !== self::IN_QUERY) {
            throw new \InvalidArgumentException(sprintf(
                'location must be one of: ["%s"]',
                implode('", "', [self::IN_ROUTE, self::IN_QUERY])
            ));
        }
        $this->name = $name;
        $this->location = $location;
        if (self::IN_ROUTE === $location) {
            $this->required();
        }
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLocation(): string {
        return $this->location;
    }

    /**
     * Is this parameter required by the part?
     *
     * @return bool
     */
    public function isRequired(): bool {
        return isset($this->validators[Validator\RequiredValidator::NAME]);
    }

    /**
     * Mark this parameter as "required", meaning it must either have a specific or default value
     *
     * @return \MyENA\PHPIPAMAPI\Parameter
     */
    public function required(): Parameter {
        $this->validators = [
                Validator\RequiredValidator::NAME => new Validator\RequiredValidator(),
            ] + $this->validators;
        return $this;
    }

    /**
     * @param $value
     * @return \MyENA\PHPIPAMAPI\Parameter
     */
    public function setValue($value): Parameter {
        $this->value = $value;
        return $this;
    }

    /**
     * Will attempt to return a usable value for this parameter preferring a specified one, falling back to
     * default (if set), and finally null
     *
     * @return mixed|null
     */
    public function getValue(): ?string {
        return $this->value ?? $this->getDefaultValue();
    }

    /**
     * @return string
     */
    public function getEncodedValue(): ?string {
        if (null === ($v = $this->getValue())) {
            return null;
        } else {
            return urlencode($v);
        }
    }

    /**
     * Sets a default value for this argument
     *
     * @param mixed $defaultValue
     * @return \MyENA\PHPIPAMAPI\Parameter
     */
    public function setDefaultValue($defaultValue): Parameter {
        $this->default = $defaultValue;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getDefaultValue() {
        return $this->default ?? null;
    }

    /**
     * @param \MyENA\PHPIPAMAPI\Parameter\Validator $validator
     * @return \MyENA\PHPIPAMAPI\Parameter
     */
    public function addValidator(Validator $validator): Parameter {
        $this->validators[$validator->name()] = $validator;
        return $this;
    }

    /**
     * Returns all validators registered with this argument
     *
     * @return array
     */
    public function getValidators(): array {
        return $this->validators;
    }

    /**
     * Attempts to return a specific validator
     *
     * @param string $name
     * @return \MyENA\PHPIPAMAPI\Parameter\Validator|null
     */
    public function getValidator(string $name): ?Validator {
        return $this->validators[$name] ?? null;
    }

    /**
     * Perform validation of this parameter against stored validators.
     *
     * TODO: Allow for fallthrough on failed validator to perform others
     *
     * @return bool
     */
    public function isValid(): bool {
        if (!$this->isRequired() && null === $this->getValue()) {
            return true;
        }
        foreach ($this->validators as $validator) {
            if (!$validator->test($this)) {
                $this->failedValidations[] = $validator;
                $this->lastFailedValidator = $validator;
                return false;
            }
        }
        return true;
    }

    /**
     * Returns the last validator to fail, if validation attempt was made
     *
     * @return \MyENA\PHPIPAMAPI\Parameter\Validator|null
     */
    public function getLastFailedValidator(): ?Validator {
        return $this->lastFailedValidator ?? null;
    }

    /**
     * Returns array of all failed validations, if any were found
     *
     * @return \MyENA\PHPIPAMAPI\Parameter\Validator[]
     */
    public function getFailedValidations(): array {
        return $this->failedValidations;
    }
}