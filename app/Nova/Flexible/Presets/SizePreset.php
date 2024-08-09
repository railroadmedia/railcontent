<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\SizeResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class SizePreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field): void
    {
        $field->resolver(SizeResolver::class);
        $field->button('Add a size');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
