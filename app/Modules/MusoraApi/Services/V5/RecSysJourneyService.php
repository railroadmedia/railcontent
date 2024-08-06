<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\MusoraApi\Jobs\ContentServedEventTrackingJob;
use Avo;
use Railroad\Railcontent\Services\RecommendationService;

class RecSysJourneyService
{
    public function __construct(private readonly RecommendationService $recommendationService)
    {
    }

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
        $user = user();
        ContentServedEventTrackingJob::dispatchAfterResponse(
            $props,
            $user,
            AvoHelper::defaultEventProperties([], $user)
        );
    }
}
