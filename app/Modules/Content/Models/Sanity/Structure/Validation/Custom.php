<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class Custom extends ValidationRule
{
    /**
     * @param  callable     $value function to call to determine validation
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
     */
    public function __construct(callable $value, ?string $warningMessage = null, ?string $errorMessage = null)
    {
        parent::__construct($value, $warningMessage, $errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return FieldType::cases();
    }
}
