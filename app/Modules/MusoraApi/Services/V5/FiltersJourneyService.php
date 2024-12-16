<?php

namespace App\Modules\MusoraApi\Services\V5;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Illuminate\Support\Str;

class FiltersJourneyService
{
    public function trackFilterApplied(array $props): void
    {
        $filters = $this->parseFilters($props);

        Avo::filter_applied(
            AvoHelper::defaultEventProperties(
                [
                    'filters' => $filters,
                    'navigation_section' => Str::kebab(strtolower($props['section'] ?? '')),
                    'brand' => $props['brand'] ?? null,
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
                    'filter_group' => $props['group'] ?? null,
                    'navigation_section' => Str::kebab(strtolower($props['section'] ?? '')),
                    'brand' => $props['brand'] ?? null,
                ],
                user()
            )
        );
    }

    public function trackSortingApplied(array $props): void
    {
        $sortType = $this->parseSort($props['sort']);

        Avo::sorting_applied(
            AvoHelper::defaultEventProperties(
                [
                    'sorting_type' => $sortType,
                    'navigation_section' => Str::kebab(strtolower($props['section'] ?? '')),
                    'brand' => $props['brand'] ?? null,
                ],
                user()
            )
        );
    }

    public function parseFilters(?array $props): array
    {
        $props = $props ?? [];
        $filters = collect($props['filters'] ?? [])->map(
            function ($filter) {
                $filterTag = explode(',', $filter);
                if (count($filterTag) !== 2) {
                    return null;
                }
                return [
                    'filter_category' => $filterTag[0],
                    'filter_tag' => $filterTag[1],
                ];
            }
        )
            ->filter(fn ($f) => !!$f)
            ->toArray();

        $filters[] = [
            'filter_category' => 'progress',
            'filter_tag' => $props['progress'] ?? 'all',
        ];

        return $filters;
    }

    public function parseSort(?string $sort): string
    {
        return match ($sort) {
            '-popularity' => 'Most Popular',
            'popularity' => 'Least Popular',
            'slug' => 'Name: A to Z',
            '-slug' => 'Name: Z to A',
            'published_on', 'created_at' => 'Oldest First',
            '-published_on', '-created_at' => 'Newest First',
            '-progress' => 'Progress',
            '-last_progress' => 'Recently Viewed',
            'most_recent' => 'Most Recent',
            'pinned' => 'Pinned',
            default => 'Unknown',
        };
    }
}
