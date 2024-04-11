<?php

namespace App\Modules\MusoraApi\Controllers\V5;

use App\Modules\MusoraApi\Services\V5\FiltersJourneyService;
use App\Modules\MusoraApi\Services\V5\RecSysJourneyService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JourneyController extends Controller
{
    public function __construct(
        private readonly FiltersJourneyService $filtersJourneyService,
        private readonly RecSysJourneyService $recSysJourneyService
    ) {
    }

    public function track(Request $request, string $event): void
    {
        $validated = $request->validate(config('journeys.v5.schema.' . $event));

        Log::info('JourneyController::track() - event: ' . $event . ' - validated: ' . json_encode($validated));

        match ($event) {
            'filter-applied' => $this->filtersJourneyService->trackFilterApplied($validated),
            'filter-group-applied' => $this->filtersJourneyService->trackFilterGroupApplied($validated),
            'sorting-applied' => $this->filtersJourneyService->trackSortingApplied($validated),
            'homepage-content-clicked' => $this->recSysJourneyService->trackHomepageContentClicked($validated),
            'homepage-section-see-all-clicked' => $this->recSysJourneyService->trackHomepageSectionSeeAllClicked(
                $validated
            ),
            default => '',
        };
    }
}
