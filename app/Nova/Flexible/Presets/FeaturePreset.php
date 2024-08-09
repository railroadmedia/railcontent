<?php

namespace App\Nova\Flexible\Presets;

use App\Models\Feature;
use App\Nova\Flexible\Resolvers\FeatureResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class FeaturePreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */


    public function handle(Flexible $field): void
    {

        $field->resolver(FeatureResolver::class);
        $field->button('Add a feature/topic');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
