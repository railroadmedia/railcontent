<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class Required extends ValidationRule
{
    public function __construct(?string $warningMessage = null, ?string $errorMessage = null)
    {
        parent::__construct(null, $warningMessage, $errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return FieldType::cases();
    }
}
