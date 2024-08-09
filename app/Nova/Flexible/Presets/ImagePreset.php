<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\ImageResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class ImagePreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field): void
    {
        $field->resolver(ImageResolver::class);
        $field->button('Add an image');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
