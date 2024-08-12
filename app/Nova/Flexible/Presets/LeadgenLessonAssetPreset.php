<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\LeadgenLessonAssetResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class LeadgenLessonAssetPreset extends Preset
{
    /**
     * Execute the preset configuration
     */
    public function handle(Flexible $field): void
    {
        $field->resolver(LeadgenLessonAssetResolver::class);
        $field->button('Add an asset');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
