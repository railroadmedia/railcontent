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
                'contentId' => ['required', 'int']
            ]
        );

        Avo::homepage_content_clicked(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $brand,
                    'homepage_section' => $section,
                    'content_id' => $contentId,
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
            ]
        );

        Avo::homepage_section_see_all_clicked(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $brand,
                    'homepage_section' => $section,
                ],
                user()
            )
        );
    }
}
