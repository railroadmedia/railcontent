<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class Regex extends ValidationRule
{
    /**
     * The field's value must match the regex pattern
     *
     * @param  string  $pattern the pattern to evaluate against
     * @param  bool $invert when true, the field's value must NOT match the pattern
     * @param  string|null  $patternName name to use to make the default error message more user-friendly
     *                      e.g. ("Does not match the <patternName>-pattern")
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
     */
    public function __construct(string $pattern, bool $invert = false, ?string $patternName = null, ?string $warningMessage = null, ?string $errorMessage = null)
    {
        $options = [];
        if ($invert) {
            $options['invert'] = $invert;
        }
        if ($patternName) {
            $options['name'] = $patternName;
        }
        $optionsString = $this->formatOptions($options);
        $formattedPattern = $this->formatPattern($pattern);
        parent::__construct(fn () => "$formattedPattern$optionsString", $warningMessage, $errorMessage);
    }

    protected function formatPattern(string $pattern): string
    {
        return '`' . addslashes($pattern) . '`';
    }

    protected function formatOptions(array $options): string
    {
        if (empty($options)) {
            return '';
        }

        $optionsParts = [];
        foreach ($options as $key => $value) {
            if (is_bool($value)) {
                $optionsParts[] = "$key: " . ($value ? 'true' : 'false');
            } else {
                $optionsParts[] = "$key: `" . addslashes($value) . "`";
            }
        }

        return ', {' . implode(', ', $optionsParts) . '}';
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return [FieldType::String, FieldType::Text];
    }
}
