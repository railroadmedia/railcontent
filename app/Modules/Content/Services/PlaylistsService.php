<?php

namespace Modules\Content\Services;

use Illuminate\Database\Eloquent\Collection;

class PlaylistsService
{
    public function processFilterOptions(Collection $filterOptions): array
    {
        $filterOptionsArray = ['categories' => []];

        // Build the filterOptions array from the results
        foreach ($filterOptions as $result) {
            $filterOptionsArray['categories'][] = $result->category . ' (' . $result->playlistsCount . ')';
        }

        return $filterOptionsArray;
    }
}
