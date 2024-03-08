<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Illuminate\Http\Request;

class FiltersEventTrackingService
{
    public function trackFilterApplied(Request $request): void
    {
        [
            'section' => $section,
            'filters' => $requestFilters,
            'progress' => $progress,
            'brand' => $brand
        ] = $request->validate(
            [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'filters' => ['required', 'array'],
                'filters.*' => ['required', 'string'],
                'progress' => ['string']
            ]
        );

        $filters = collect($requestFilters)->map(
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
            'filter_tag' => $progress ?? 'all',
        ];

        Avo::filter_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filters' => $filters,
                    'navigation_section' => $section,
                    'brand' => $brand,
                ],
                user()
            )
        );
    }

    public function trackFilterGroupApplied(Request $request): void
    {
        ['section' => $section, 'group' => $group, 'brand' => $brand] = $request->validate(
            [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'group' => ['required', 'string'],
            ]
        );

        Avo::filter_group_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filter_group' => $group,
                    'navigation_section' => $section,
                    'brand' => $brand,
                ],
                user()
            )
        );
    }

    public function trackSortingApplied(Request $request): void
    {
        ['section' => $section, 'sort' => $sort, 'brand' => $brand] = $request->validate(
            [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'sort' => ['required', 'string'],
            ]
        );

        $sortType = match ($sort) {
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
                    'navigation_section' => $section,
                    'brand' => $brand,
                ],
                user()
            )
        );
    }
}
