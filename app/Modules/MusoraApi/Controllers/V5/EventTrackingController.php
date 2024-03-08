<?php

namespace App\Modules\MusoraApi\Controllers\V5;

use App\Modules\MusoraApi\Services\V5\FiltersEventTrackingService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class EventTrackingController extends Controller
{
    public function __construct(private readonly FiltersEventTrackingService $filtersEventTrackingService)
    {
    }

    public function track(Request $request, string $event): void
    {
        match ($event) {
            'filter-applied' => $this->filtersEventTrackingService->trackFilterApplied($request),
            'filter-group-applied' => $this->filtersEventTrackingService->trackFilterGroupApplied($request),
            'sorting-applied' => $this->filtersEventTrackingService->trackSortingApplied($request),
            default => '',
        };
    }
}
