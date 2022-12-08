<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\SpecResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class SpecPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $field->resolver(SpecResolver::class);
        $field->button('Add a spec');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
