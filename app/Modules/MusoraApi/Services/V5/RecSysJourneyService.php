<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;

class RecSysJourneyService
{
    public function trackHomepageContentClicked(array $props): void
    {
        Avo::homepage_content_clicked(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $props['brand'] ?? null,
                    'homepage_section' => $props['section'] ?? null,
                    'content_id' => $props['contentId'] ?? null,
                ],
                user()
            )
        );
    }

    public function trackHomepageSectionSeeAllClicked(array $props): void
    {
        Avo::homepage_section_see_all_clicked(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $props['brand'] ?? null,
                    'homepage_section' => $props['section'] ?? null,
                ],
                user()
            )
        );
    }

    public function trackRecommendedContentServed(array $props): void
    {
        // TODO: parse data based on event schema
        Avo::recommended_content_served(
            AvoHelper::defaultEventProperties(
                [
                    'brand' => $props['brand'] ?? null,
                    'homepage_section' => $props['section'] ?? null,
                ],
                user()
            )
        );
    }
}
