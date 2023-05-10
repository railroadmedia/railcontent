<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\CohortDropdownResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class CohortDropdownPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $field->resolver(CohortDropdownResolver::class);
        $field->button('Add a dropdown');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
