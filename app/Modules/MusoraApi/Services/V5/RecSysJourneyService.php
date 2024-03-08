<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Illuminate\Http\Request;

class RecSysJourneyService
{
    public function trackHomepageContentClicked(Request $request): void
    {
        ['section' => $section, 'contentId' => $contentId, 'brand' => $brand] = $request->validate(
            [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'filters' => ['required', 'array'],
                'filters.*' => ['required', 'string'],
                'progress' => ['string']
            ]
        );

        Avo::homepage_content_clicked(
            AvoHelper::defaultEventProperties(
                [
                    'content_id' => $contentId,
                    'homepage_section' => $section,
                    'brand' => $brand,
                ],
                user()
            )
        );
    }

    public function trackHomepageSectionSeeAllClicked(Request $request): void
    {
        ['section' => $section, 'brand' => $brand] = $request->validate(
            [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'filters' => ['required', 'array'],
                'filters.*' => ['required', 'string'],
                'progress' => ['string']
            ]
        );

        Avo::homepage_section_see_all_clicked(
            AvoHelper::defaultEventProperties(
                [
                    'homepage_section' => $section,
                    'brand' => $brand,
                ],
                user()
            )
        );
    }
}
