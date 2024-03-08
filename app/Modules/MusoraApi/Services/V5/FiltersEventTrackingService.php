<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Support\Facades\Log;

class FiltersEventTrackingService
{
    public function trackFilterApplied(array $properties): void
    {
        if (!isset($properties['section']) || !isset($properties['filters'])) {
            Log::error("FiltersEventTrackingService::trackFilterApplied: section or filters not set", $properties);
            return;
        }

        $filters = collect($properties['filters'])->map(
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
            'filter_tag' => $properties['progress'] ?? 'all',
        ];

        Avo::filter_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filters' => $filters,
                    'navigation_section' => $properties['section'],
                    'brand' => $properties['brand'] ?? brand(),
                ],
                user()
            )
        );
    }

    public function trackFilterGroupApplied(array $properties): void
    {
        if (!isset($properties['section']) || !isset($properties['group'])) {
            Log::error("FiltersEventTrackingService::trackFilterApplied: section or sort not set", $properties);
            return;
        }

        Avo::filter_group_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filter_group' => $properties['group'],
                    'navigation_section' => $properties['section'],
                    'brand' => brand(),
                ],
                user()
            )
        );
    }

    public function trackSortingApplied(array $properties): void
    {
        if (!isset($properties['section']) || !isset($properties['sort'])) {
            Log::error("FiltersEventTrackingService::trackFilterApplied: section or sort not set", $properties);
            return;
        }

        $sortType = match ($properties['sort']) {
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
                    'navigation_section' => $properties['section'],
                    'brand' => brand(),
                ],
                user()
            )
        );
    }
}
