<?php

namespace App\Modules\Content\Models\Sanity\Structure\Validation\Custom;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Validation\ValidationRule;

/**
 * A custom validation rule that limits the allowed number of characters in a Block (Array) input field
 */
class BlockCharacterLengthMax extends ValidationRule
{
    public function __construct(int $maxCharacters, ?string $warningMessage = null, ?string $errorMessage = null)
    {
        parent::__construct($maxCharacters, $warningMessage, $errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function getSupportedFieldTypes(): array
    {
        return [FieldType::Array];
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return sprintf(
            "custom(blocks => blocks ? blocks.reduce((count, block) => count + (block.children || []).reduce((childCount, child) => childCount + (child.text || '').length, 0), 0) <= %d || '%s' : true)",
            $this->value,
            addslashes($this->errorMessage ?? sprintf('Exceeds maximum limit of %d characters.', $this->value))
        );
    }
}
