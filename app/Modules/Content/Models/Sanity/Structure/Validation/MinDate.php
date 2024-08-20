<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class MinDate extends ValidationRule
{
    /**
     * @param  string  $value  the ISO 8601 string format of the minimum date,
     *                      or the string name of the field to reference if $useValueOfField is true
     * @param  bool  $useValueOfField when set, the $value is the name of a field to use the value of as the minimum date
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
     */
    public function __construct(string $value, bool $useValueOfField, ?string $warningMessage = null, ?string $errorMessage = null)
    {
        if ($useValueOfField) {
            $value = "rule.valueOfField('$value')";
        }
        parent::__construct($value, $warningMessage, $errorMessage);
    }

    /**
     * Get the name of the validation rule
     *
     * @return string
     */
    protected function ruleName(): string
    {
        return 'min';
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return [FieldType::Date, FieldType::Datetime];
    }
}
