<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Illuminate\Http\Request;

class FiltersJourneyService
{
    public function trackFilterApplied(array $props): void
    {
        $filters = collect($props['filters'] ?? [])->map(
            function ($filter) {
                $filterTag = explode(',', $filter);
                return [
                    'filter_category' => $filterTag[0],
                    'filter_tag' => $filterTag[1],
                ];
            }
        )->toArray();

        $filters[] = [
            'filter_category' => 'progress',
            'filter_tag' => $props['progress'] ?? 'all',
        ];

        Avo::filter_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filters' => $filters,
                    'navigation_section' => $props['section'],
                    'brand' => $props['brand'],
                ],
                user()
            )
        );
    }

    public function trackFilterGroupApplied(array $props): void
    {
        Avo::filter_group_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filter_group' => $props['group'],
                    'navigation_section' => $props['section'],
                    'brand' => $props['brand'],
                ],
                user()
            )
        );
    }

    public function trackSortingApplied(array $props): void
    {
        $sortType = match ($props['sort']) {
            '-popularity' => 'Most Popular',
            'popularity' => 'Least Popular',
            'slug' => 'Name: A to Z',
            '-slug' => 'Name: Z to A',
            'published_on' => 'Oldest first',
            default => 'Newest First',
        };

        Avo::sorting_applied(
            AvoHelper::defaultEventProperties(
                [
                    'sorting_type' => $sortType,
                    'navigation_section' => $props['section'],
                    'brand' => $props['brand'],
                ],
                user()
            )
        );
    }
}
