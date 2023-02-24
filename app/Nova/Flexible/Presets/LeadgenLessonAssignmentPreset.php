<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\LeadgenLessonAssignmentResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class LeadgenLessonAssignmentPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $field->resolver(LeadgenLessonAssignmentResolver::class);
        $field->button('Add an assignment');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
