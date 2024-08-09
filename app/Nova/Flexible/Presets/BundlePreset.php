<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\BundleResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class BundlePreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field): void
    {
        $field->resolver(BundleResolver::class);
        $field->button('Add a bonus');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
