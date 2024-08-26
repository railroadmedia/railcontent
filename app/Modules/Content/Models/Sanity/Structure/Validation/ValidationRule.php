<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

abstract class ValidationRule
{
    public function __construct(public mixed $value = null, public ?string $warningMessage = null, public ?string $errorMessage = null)
    {
    }

    /**
     * Format the validation rule into a string so that it can be rendered as part of a field
     *
     * @return string
     */
    public function toString(): string
    {
        $value = $this->formatValue($this->value);

        $ruleString = sprintf('%s(%s)', $this->ruleName(), $value);

        if ($this->warningMessage) {
            $ruleString .= ".warning(`$this->warningMessage`)";
        }

        if ($this->errorMessage) {
            $ruleString .= ".error(`$this->errorMessage`)";
        }

        return $ruleString;
    }

    /**
     * Get the name of the validation rule
     *
     * @return string
     */
    protected function ruleName(): string
    {
        return lcfirst(class_basename($this));
    }

    /**
     * Format the rule's validation value into a string (or null, if not applicable)
     * @param  mixed  $value
     *
     * @return string|null
     */
    protected function formatValue(mixed $value): ?string
    {
        if (is_callable($value)) {
            return call_user_func($value);
        }

        return $value;
    }

    /**
     * Get the array of all field types that support this validation rule
     *
     * @return array
     */
    abstract public function getSupportedFieldTypes(): array;
}
