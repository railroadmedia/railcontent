<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation;

use App\Modules\Content\Models\Sanity\Enums\FieldType;

class AssetRequired extends ValidationRule
{
    /**
     * Like required but more specific. Requires that an actual asset is referenced to validate.
     * Must be used together with required, i.e.: validation: [new Required(), new AssetRequired()],
     *
     * @param  string|null  $warningMessage
     * @param  string|null  $errorMessage
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
        return [FieldType::File, FieldType::Image];
    }
}
