<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class Positive extends ValidationRule
{
    /**
     * The field's value must be a positive number (>= 0)
     */
    public function __construct(?string $warningMessage = null, ?string $errorMessage = null)
    {
        parent::__construct(null, $warningMessage, $errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return [FieldType::Number];
    }
}
