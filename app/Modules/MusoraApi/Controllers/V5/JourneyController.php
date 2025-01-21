<?php

namespace App\Modules\MusoraApi\Controllers\V5;

use App\Modules\MusoraApi\Services\V5\ContentJourneyService;
use App\Modules\MusoraApi\Services\V5\VideoJourneyService;
use App\Modules\MusoraApi\Services\V5\FiltersJourneyService;
use App\Modules\MusoraApi\Services\V5\RecSysJourneyService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    public function __construct(
        private readonly FiltersJourneyService $filtersJourneyService,
        private readonly RecSysJourneyService $recSysJourneyService,
        private readonly VideoJourneyService $videoJourneyService,
        private readonly ContentJourneyService $contentJourneyService
    ) {
    }

    public function track(Request $request, string $event): void
    {
        $validated = $request->validate(config('journeys.v5.schema.' . $event));

        match ($event) {
            'filter-applied' => $this->filtersJourneyService->trackFilterApplied($validated),
            'filter-group-applied' => $this->filtersJourneyService->trackFilterGroupApplied($validated),
            'sorting-applied' => $this->filtersJourneyService->trackSortingApplied($validated),
            'homepage-content-clicked' => $this->recSysJourneyService->trackHomepageContentClicked($validated),
            'homepage-section-see-all-clicked' => $this->recSysJourneyService->trackHomepageSectionSeeAllClicked($validated),
            'recommended-content-served' => $this->recSysJourneyService->trackRecommendedContentServed($validated),
            'video-started' => $this->videoJourneyService->trackVideoStarted($validated),
            'video-resumed' => $this->videoJourneyService->trackVideoResumed($validated),
            'video-playing' => $this->videoJourneyService->trackVideoPlaying($validated),
            'video-paused' => $this->videoJourneyService->trackVideoPaused($validated),
            'video-completed' => $this->videoJourneyService->trackVideoCompleted($validated),
            'content-liked' => $this->contentJourneyService->trackContentLiked($validated),
            'content-unliked' => $this->contentJourneyService->trackContentUnliked($validated),
            default => '',
        };
    }
}
