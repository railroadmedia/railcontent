<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class Uri extends ValidationRule
{
    /**
     * The field's value must meet the specified URI options
     *
     * @param  string|array  $scheme String, RegExp or Array of schemes to allow
     * @param  bool  $allowRelative Whether to allow relative URLs
     * @param  bool  $relativeOnly Whether to only allow relative URLs
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
     */
    public function __construct(
        string|array $scheme = ['http', 'https'],
        bool $allowRelative = false,
        bool $relativeOnly = false,
        ?string $warningMessage = null,
        ?string $errorMessage = null
    ) {

        $options['scheme'] = $this->formatScheme($scheme);
        if ($allowRelative) {
            $options['allowRelative'] = $allowRelative;
        }
        if ($relativeOnly) {
            $options['relativeOnly'] = $relativeOnly;
        }

        parent::__construct($this->formatOptions($options), $warningMessage, $errorMessage);
    }

    protected function formatScheme(string|array $scheme): string
    {
        if (is_array($scheme)) {
            $formattedSchemes = array_map(fn ($s) => "`$s`", $scheme);
            return '[' . implode(', ', $formattedSchemes) . ']';
        }
        return "`$scheme`";
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
                $optionsParts[] = "$key: $value";
            }
        }

        return '{' . implode(', ', $optionsParts) . '}';
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return [FieldType::URL];
    }
}
