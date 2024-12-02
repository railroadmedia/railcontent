<?php

namespace Modules\Content\Services;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use App\Modules\Content\Models\UserPlaylistPinned;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PlaylistsService
{
    public function __construct(
        private SanityGateway $sanityGateway,
    ) {
    }

    public function processFilterOptions(Collection $filterOptions): array
    {
        $filterOptionsArray = ['categories' => []];

        // Build the filterOptions array from the results
        foreach ($filterOptions as $result) {
            $filterOptionsArray['categories'][] = $result->category . ' (' . $result->playlistsCount . ')';
        }

        return $filterOptionsArray;
    }

    /**
     * Updates the total duration of a given user playlist by summing the `length_in_seconds`
     * of its associated content items.
     *
     * This method retrieves all items in the specified playlist, fetches additional data
     * from Sanity, and calculates the total duration by summing each content item's `length_in_seconds`.
     * The resulting duration is then saved to the `duration` field of the playlist.
     *
     * @param  UserPlaylist  $playlist  The playlist for which to update the duration.
     * @return UserPlaylist  The updated playlist instance with the calculated duration.
     */
    public function updateDuration(UserPlaylist $playlist): UserPlaylist
    {
        $items = UserPlaylistContent::query()
            ->where('user_playlist_id', $playlist->id)
            ->orderBy('position', 'asc')
            ->get();

        $contentIds = $items->pluck('content_id');

        // Fetch Sanity data and key it by railcontent_id
        $sanityData = collect($this->sanityGateway->getByRailContentIds($contentIds->toArray(), 'playlist-item'))
            ->keyBy('railcontent_id');

        // Calculate total duration
        $totalDuration = collect($contentIds)->reduce(function ($carry, $item) use ($sanityData) {
            if (isset($sanityData[$item])) {
                $lengthInSeconds = $sanityData[$item]['length_in_seconds'] ?? 0;
                return $carry + $lengthInSeconds;
            } else {
                return $carry;
            }
        }, 0);

        // Update and save the playlist duration
        $playlist->duration = $totalDuration;
        $playlist->save();

        return $playlist;
    }

    /**
     * Retrieves the items in a specific playlist, fetches related Sanity and Assignment data,
     * and formats the data for each item.
     *
     * @param string $brand        The brand associated with the playlist.
     * @param int $playlistId      The ID of the playlist whose items are being retrieved.
     * @param string $sort         Sorting parameter; 'position' by default; 'random' to shuffle items
     * @return array               An array of formatted playlist item data.
     */
    public function getPlaylistItems(string $brand, int $playlistId,  $sort = "position"): \Illuminate\Support\Collection|array
    {
        $query = UserPlaylistContent::query()
            ->where('user_playlist_id', $playlistId);
        if ($sort == 'random') {
            $query = $query->inRandomOrder();
        } else{
            $query = $query ->orderBy('position', 'asc');
        }

        $items = $query->get();

        $contentIds = $items->pluck('content_id');
        $parentIds = $items->pluck('content_parent')->filter();

        // Fetch Sanity and Assignment data
        $sanityData = $this->sanityGateway->getByRailContentIds($contentIds->toArray(), 'playlist-item', null, true);

        $assignmentsData = $this->sanityGateway->getAssignmentsByRailcontentIds(
            $brand,
            $contentIds->toArray(),
            $parentIds->toArray(),
            'playlist-item',
            true
        );

        $sanityDataAssoc = collect($sanityData)->keyBy('railcontent_id');
        $assignmentDataAssoc = collect($assignmentsData)->keyBy('railcontent_id');
        $userPermissions = user()->getActivePermissionsIds();

        $mergedData = $items->map(function ($item) use ($sanityDataAssoc, $assignmentDataAssoc, $playlistId, $userPermissions) {
            return $this->formatPlaylistItemData($item, $sanityDataAssoc, $assignmentDataAssoc, $playlistId, $userPermissions);
        });

        return $mergedData;
    }

    /**
     * Formats the data for a playlist item by merging information from Sanity, assignments, and item-specific data.
     *
     * @param mixed $item                    The playlist item being formatted.
     * @param \Illuminate\Support\Collection $sanityDataAssoc     A collection of Sanity data keyed by content ID.
     * @param \Illuminate\Support\Collection $assignmentDataAssoc A collection of assignment data keyed by content ID.
     * @param int $playlistId                The ID of the playlist the item belongs to.
     * @param array $userPermissions         An array of user permissions to check access for the playlist item.
     * @return array                         The formatted playlist item data, including route, metadata, and permissions.
     */
    public function formatPlaylistItemData( mixed $item,
        \Illuminate\Support\Collection $sanityDataAssoc,
        \Illuminate\Support\Collection $assignmentDataAssoc,
        int $playlistId,
        array $userPermissions): array
    {
        $sanityInfo = $sanityDataAssoc->get($item->content_id);
        $assignmentInfo = $assignmentDataAssoc->get($item->content_id);

        // Process route information if it exists in Sanity data
        if (!empty($sanityInfo['parents'] ?? [])) {
            $route = collect($sanityInfo['parents'])->map(function ($parent) use ($sanityInfo) {
                switch ($parent['type']) {
                    case 'user-playlist':
                        return null;
                    case 'edge-pack':
                        return null;
                    case 'learning-path':
                        return 'Method';
                    case 'learning-path-level':
                        return 'L' . collect($sanityInfo['parent_content_data'])->keyBy('id')[$parent['id']]['position'];
                    case 'foundation':
                        return 'Method';
                    default:
                        return $parent['title'];
                }
            })->filter()->toArray();
            $sanityInfo['route'] = array_reverse($route);
        }

        $item->thumbnail_url = $assignmentInfo ? $assignmentInfo['thumbnail'] : ($sanityInfo['thumbnail'] ?? null);
        $item->item_type = $item->type = $assignmentInfo ? $assignmentInfo['item_type'] : ($sanityInfo['type'] ?? null);
        $item->user_playlist_item_extra_data = $item['extra_data'] ?? null;
        $item->duration = $sanityInfo['length_in_seconds'] ?? null;
        $item->playlist_item_name = $item->playlist_item_name ?? $item->content_name;
        $item->user_playlist_item_id = $item->id;
        $item->id = $item->content_id;
        $item->instructors = $assignmentInfo ? $assignmentInfo['instructors'] : ($sanityInfo['instructors'] ?? null);
        $item->route = $assignmentInfo ? $assignmentInfo['route'] : ($sanityInfo['route'] ?? []);
        $item->url = url()->route('platform.user.playlist-item', [
            'playlistId' => $playlistId,
            'playlistItemId' => $item->user_playlist_item_id,
        ]);

        $data = array_merge($sanityInfo ?? [], $assignmentInfo ?? [], $item->toArray());
        // Check if the user needs access
        $permissions = $data['permission_id'] ?? [];
        $data['need_access'] = !user()->isAdmin() && empty(array_intersect($userPermissions, $data['permission_id'])) && !empty($permissions);

        if ($data['need_access']) {
            // Define membership checks
            $needLifetime = !empty(array_intersect(UserAccessPermissionsCollection::LifetimePermissions, $permissions));
            $needMusoraBasic = in_array(UserAccessPermissionsCollection::MusoraBasicMembershipPermission, $permissions);
            $needMusoraPlus = in_array(UserAccessPermissionsCollection::MusoraPlusMembershipPermission, $permissions);

            // Determine the message based on membership needs
            if ($needLifetime) {
                $data['need_access_message'] = 'This Masterclass is part of our exclusive <b>Lifetime Membership</b>.';
            } elseif ($needMusoraBasic) {
                $data['need_access_message'] = 'This lesson is part of our <b>Musora Membership</b>.';
            } elseif ($needMusoraPlus) {
                $user = user();
                $data['show_plus_upgrade_modal'] = $user && !($user->isPackOnlyOwner() || $user->isAnExpiredMember());
                $data['need_access_message'] = 'This Song content is part of our <b>Musora+ Membership</b>.';
            }

            // Always show modal for 'song' type
            if ($item->type === 'song') {
                $data['show_plus_upgrade_modal'] = true;
            }
        }

        // Decode and merge 'extra_data' if it exists
        if (!empty($data['extra_data'])) {
            $extraData = json_decode($data['extra_data'], true);
            if (is_array($extraData)) {
                $data = array_merge($data, $extraData);
            }
        }

        if ($data['type'] == 'routine' && isset($data['is_high_routine'])) {
            $data['soundslice_slug'] = $data['high_soundslice_slug'];
        }

        if ($data['type'] == 'routine' && isset($data['is_low_routine'])) {
            $data['soundslice_slug'] = $data['low_soundslice_slug'];
        }

        return $data;
    }

    /**
     * Retrieves playlists for the current user based on various filters and sorting options.
     *
     * @param mixed                               $sort            Sorting parameter, e.g., 'name', 'id', or '-created_at'.
     * @param \App\Modules\Brand\Enums\Brand|null $brand           Optional brand to filter playlists.
     * @param mixed                               $term            Search term for playlist filtering.
     * @param mixed                               $limit           Number of playlists per page.
     * @param mixed                               $page            Current page number for pagination.
     * @param mixed|null                          $itemIdToCheck   Optional item ID to check if it exists in the playlists.
     * @return array                              An array containing playlist data and metadata, including filter options.
     */
    public function getPlaylists(mixed $sort, ?Brand $brand, mixed $term, mixed $limit, mixed $page, mixed $itemIdToCheck = null): array
    {
        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn    = trim($sort, '-');
        if (!in_array($orderByColumn, ['name', 'id', 'created_at', 'last_progress', 'most_recent', 'pinned'])) {
            $orderByColumn = 'id';
        }

        $user = user();

        $playlists    = UserPlaylist::query()
            ->where('railcontent_user_playlists.user_id', $user->id)
            ->when(!is_null($brand), fn($query) => $query->ofBrand($brand))
            ->searchTerm($term)
            ->sortBy($orderByColumn, $orderByDirection)
            ->paginate($limit, ['*'], 'page', $page);
        $totalResults = $playlists->total();

        if ($itemIdToCheck) {
            $playlists->getCollection()->map(function ($playlist) use ($itemIdToCheck) {
                $playlist->is_added_to_playlist = $playlist->items->pluck('content_id')->contains($itemIdToCheck);

                return $playlist;
            });
        }

        // Formatting durations and URLs for playlists
        $playlists = $this->formatPlaylists($playlists->items());

        // Filter options processing
        $filterOptions      = UserPlaylist::filterOptions($user->id, $brand, $term)->get();
        $filterOptionsArray = $this->processFilterOptions($filterOptions);

        // Final results structure
        $results = [
            'data' => $playlists,
            'meta' => [
                'filterOptions' => $filterOptionsArray,
                'limit'         => $limit,
                'page'          => $page,
                'totalResults'  => $totalResults
            ]
        ];

        return $results;
    }

    /**
     * Format the playlists with durations and URLs.
     *
     * @param array $playlists The playlists to format.
     * @return array The formatted playlists.
     */
    public function formatPlaylists(array $playlists): array
    {

        foreach ($playlists as $index => $playlist) {
            $pinned = $playlist->pins()->where('user_id', user()->id)->exists();
            $playlists[$index] = $playlist->toArray();
            $minsec                                 = gmdate("i:s", $playlists[$index]['duration'] ?? 0);
            $hours                                  = (gmdate("d", $playlists[$index]['duration'] ?? 0) - 1) * 24 + gmdate("H", $playlists[$index]['duration'] ?? 0);
            $playlists[$index]['duration_formated'] = ($hours == 0) ? $minsec : $hours . ':' . $minsec;
            $playlists[$index]['url']               =
                url()->route('platform.user.playlist', ["id" => $playlist['id'], "brand" => brand()]);

            $playlists[$index]['playback_url'] = url()->route('platform.play.playlist', [
                'playlistId' => $playlist['id'],
            ]);

            $playlists[$index]['description'] = $playlist['description'] ?? '';
            $playlists[$index]['total_items'] = count($playlist['items'] ?? []);
            $playlists[$index]['thumbnail_url'] = $playlists[$index]['thumbnail_url'] ?? $playlists[$index]['first_item_thumbnail_url'] ?? '';
            $playlists[$index]['pinned'] = $pinned;
            $playlists[$index]['is_my_playlist'] = $playlists[$index]['user_id'] == user()->id;
        }

        return $playlists;
    }

    /**
     * Retrieves and formats all playlists pinned by the current user for a specific brand.
     *
     * @param string $brand The brand for which pinned playlists should be retrieved.
     * @return array An array of formatted pinned playlists.
     */
    public function getPinnedPlaylists(string $brand): array
    {
        $playlists = UserPlaylist::whereHas('pins', function ($query) {
            $query->where('user_id', user()->id);
        })->with('pins')->where('brand','=',$brand)->get();

        return  $this->formatPlaylists($playlists->all());
    }

    /**
     * Pins a playlist for the current user if the allowed pin limit has not been reached.
     *
     * @param UserPlaylist $playlist
     * @return int|UserPlaylistPinned
     */
    public function pinPlaylist(UserPlaylist $playlist): int|UserPlaylistPinned
    {
        $allowedPinNumber = config('railcontent.pinned_playlists_nr', 5);
        $pinnedPlaylistsCount = UserPlaylist::whereHas('pins', function ($query) {
            $query->where('user_id', user()->id);
        })->with('pins')->where('brand','=',$playlist->brand)->count();
        if($pinnedPlaylistsCount < $allowedPinNumber){
            $pinnedData = [
                'user_id'      => user()->id,
                'playlist_id'         => $playlist->id,
                'created_at'   => Carbon::now()->toDateTimeString(),
                'brand' => $playlist->brand
            ];
            UserPlaylistPinned::create($pinnedData);
            return 1;
        } else {
            return -1;
        }
    }

    /**
     * @param \App\Modules\Content\Models\UserPlaylist $playlist
     * @return bool
     */
    public function unpinPlaylist(UserPlaylist $playlist): bool
    {
        return UserPlaylistPinned::where('user_id', user()->id)
            ->where('playlist_id', $playlist->id)
            ->delete();
    }
}
