<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Resolvers\LeadgenLessonResolver;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class LeadgenLessonPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $field->resolver(LeadgenLessonResolver::class);
        $field->button('Add a lesson');
        // You can call all available methods on the Flexible field.
        // $field->addLayout(...)
        // $field->button(...)
        // $field->resolver(...)
        // ... and so on.
    }

}
