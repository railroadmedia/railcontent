<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Layouts\CohortListLayout;
use App\Nova\Flexible\Resolvers\CohortDropdownResolver;
use App\Nova\Flexible\Resolvers\CohortListResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class CohortListPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field): void
    {
        $field->resolver(CohortListResolver::class);
        $field->button('Add an item');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
