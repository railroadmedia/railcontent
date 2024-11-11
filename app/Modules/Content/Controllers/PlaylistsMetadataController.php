<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use App\Modules\Content\Models\UserPlaylistLike;
use App\Modules\Content\Requests\AddItemToPlaylistRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Services\PlaylistsService;
use Railroad\Railcontent\Events\PlaylistItemsUpdated;

class PlaylistsMetadataController extends Controller
{
    public function __construct(
        private PlaylistsService $playlistsService,
        private SanityGateway $sanityGateway
    ) {
    }

    /**
     *  Retrieves the user's playlists from the database.
     *
     * This method processes the request to fetch a paginated list of playlists
     * for the authenticated user. It allows optional filtering by brand,
     * pagination through page and limit parameters, and sorting by specified columns.
     *
     * @param \Illuminate\Http\Request $request - The incoming HTTP request containing query parameters.
     * @return \Illuminate\Http\JsonResponse - A JSON response containing the playlists data along with metadata.
     */
    public function getUserPlaylists(Request $request): JsonResponse
    {
        $brandValue = $request->get('brand');
        $brand      = null;
        if ($brandValue) {
            $brand = Brand::from($brandValue);
        }
        $page             = $request->get('page', 1);
        $limit            = $request->get('limit', 10);
        $sort             = $request->get('sort', '-created_at');
        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn    = trim($sort, '-');
        if (!in_array($orderByColumn, ['name', 'id', 'created_at', 'last_progress', 'most_recent', 'pinned'])) {
            $orderByColumn = 'id';
        }
        $user = user();

        $playlists = UserPlaylist::with('items')
            ->where('railcontent_user_playlists.user_id', $user->id)
            ->when(!is_null($brand), fn ($query) => $query->ofBrand($brand))
            ->searchTerm($request->get('term'))
            ->sortBy($orderByColumn, $orderByDirection)
            ->paginate($limit, ['*'], 'page', $page);
        $totalResults = $playlists->total();

        // Formatting durations and URLs for playlists
        $playlists = $this->formatPlaylists($playlists->items());

        // Filter options processing
        $filterOptions = UserPlaylist::filterOptions($user->id, $brand, $request->get('term'))->get();
        $filterOptionsArray = $this->playlistsService->processFilterOptions($filterOptions);

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

        return response()->json($results);
    }

    public function duplicatePlaylist($playlistId, Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
                                                'name'        => 'nullable|string|max:255',
                                                'description' => 'nullable|string|max:1000',
                                                'category'        => 'nullable|string|max:255',
                                                'private'       => 'nullable|boolean',
                                                'thumbnail_url' => 'nullable|url',
                                            ]);

        $user = user();
        $originalPlaylist = UserPlaylist::with('items')->find($playlistId);
        if(!$originalPlaylist){
            return response()->json([
                                        'success' => false,
                                        'error' => 'Playlist do not exists'
                                    ], 404);
        }

        $newPlaylist = $originalPlaylist->replicate();
        $newPlaylist->name = $request->get('name', $originalPlaylist->name . ' (Duplicate)');
        $newPlaylist->description = $request->get('description', $originalPlaylist->description);
        $newPlaylist->category = $request->get('category', $originalPlaylist->category);
        $newPlaylist->thumbnail_url = $request->get('thumbnail_url', $originalPlaylist->thumbnail_url);
        $newPlaylist->user_id = $user->id;
        $newPlaylist->created_at = now();
        $newPlaylist->updated_at = now();
        $newPlaylist->save();

        foreach ($originalPlaylist->items as $content) {
            $newContent = $content->replicate();
            $newContent->user_playlist_id = $newPlaylist->id;
            $newContent->save();
        }

        return $newPlaylist;
    }

    public function deletePlaylistWithItems($playlistId, Request $request)
    {
        $playlist = UserPlaylist::find($playlistId);
        if(!$playlist){
            return response()->json([
                                        'success' => false,
                                        'error' => 'Playlist do not exists'
                                    ], 404);
        }
        // Ensure the authenticated user is the owner of the playlist
        if ($playlist->user_id !== user()->id) {
            return response()->json([
                'success' => false,
                'error' => 'You don’t have access to delete this playlist.'], 403);
        }

        $playlist->items()->delete();  // Deletes all related playlist items
        $playlist->delete();  // Deletes the playlist

        return response()->json([
            'success' => true,
            'message' => 'Playlist and associated items deleted successfully.']);
    }

    public function updatePlaylist(Request $request, $playlistId): JsonResponse
    {
        // Validate incoming data
        $validatedData = $request->validate([
                                                'name'        => 'nullable|string|max:255',
                                                'description' => 'nullable|string|max:1000',
                                                'category'        => 'nullable|string|max:255',
                                                'private'       => 'nullable|boolean',
                                                'thumbnail_url' => 'nullable|url',
                                            ]);

        // Find the playlist by ID
        $playlist = UserPlaylist::find($playlistId);
        if(!$playlist){
            return response()->json([
                                        'success' => false,
                                        'error' => 'Playlist do not exists'
                                    ], 404);
        }
        if ($playlist->user_id !== user()->id) {
            return response()->json(['success' => false,
                                     'error' => 'You don’t have access to update this playlist'], 403);
        }

        // Update the playlist with validated data
        $playlist->update($validatedData);

        return response()->json([
                                    'success' => true,
                                    'message'   => 'Playlist updated successfully',
                                    'playlist'  => $playlist,
                                ], 201);
    }

    public function createPlaylist(Request $request): JsonResponse
    {
        // Validate incoming data
        $validatedData = $request->validate([
                                                'name'          => 'required|string|max:255',
                                                'description'   => 'nullable|string|max:1000',
                                                'category'      => 'nullable|string|max:255',
                                                'thumbnail_url' => 'nullable|url',
                                                'private'       => 'nullable|boolean',
                                                'brand'         => 'nullable|string',
                                            ]);

        $playlistData = [
            'user_id'      => user()->id, // Assuming the user() helper fetches the authenticated user
            'type'         => 'user-playlist',
            'brand'        => $validatedData['brand'] ?? config('railcontent.brand'),
            'name'         => $validatedData['name'],
            'description'  => $validatedData['description'] ?? '',
            'thumbnail_url' => $validatedData['thumbnail_url'] ?? null,
            'category'     => $validatedData['category'] ?? null,
            'private'      => $validatedData['private'] ?? true,
            'created_at'   => Carbon::now()->toDateTimeString(),
        ];

        $playlist = UserPlaylist::create($playlistData);

        return response()->json([
                                    'message'   => 'Playlist created successfully',
                                    'playlist'  => $playlist,
                                ], 201);
    }

    public function likePlaylist(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
                                                'playlist_id' => 'required|integer|exists:railcontent_user_playlists,id',
                                            ]);

        $playlistId = $validatedData['playlist_id'];
        $userId = user()->id;
        $brand = $request->get('brand') ?? config('railcontent.brand');

        $existingLike = UserPlaylistLike::where('playlist_id', $playlistId)
            ->where('user_id', $userId)
            ->where('brand', $brand)
            ->exists();

        if ($existingLike) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'You already liked this playlist.',
                                    ], 200);
        }

        // Create a new like if it doesn't exist
        $like = new UserPlaylistLike();
        $like->playlist_id = $playlistId;
        $like->user_id = $userId;
        $like->brand = $brand;
        $like->created_at = Carbon::now()->toDateTimeString();
        $like->save();

        return response()->json([
                                    'success' => true,
                                    'message' => 'Playlist liked successfully',
                                    'like' => $like,
                                ], 201);
    }

    public function deletePlaylistLike(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
                                                'playlist_id' => 'required|integer|exists:railcontent_user_playlists,id',
                                            ]);

        $playlistId = $validatedData['playlist_id'];
        $userId = user()->id; // Assuming you have a way to get the current user ID
        $brand = $request->get('brand') ?? config('railcontent.brand');

        // Find the existing like
        $like = UserPlaylistLike::where('playlist_id', $playlistId)
            ->where('user_id', $userId)
            ->where('brand', $brand)
            ->first();

        // If the like does not exist, return a message
        if (!$like) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'You have not liked this playlist.',
                                    ], 404);
        }

        // Delete the like
        $like->delete();

        return response()->json([
                                    'success' => true,
                                    'message' => 'Playlist like removed successfully.',
                                ], 200);
    }

    public function getPlaylist($playlistId, Request $request)
    {
        $user = user();
        $playlist = UserPlaylist::find($playlistId);
        if(!$playlist) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'Playlist not exists.',
                                    ], 404);
        }

        if($playlist->user_id != $user->id && $playlist->private == true){
            return response()->json([
                                        'success' => false,
                                        'message' => 'You don’t have access to this playlist',
                                    ], 403);
        }

        //        throw_if(
        //            ($playlist == -2),
        //            new NotFoundException(
        //                "You don’t have access to this playlist. Unblock the playlist owner to access the playlist.  ",
        //                'Blocked Playlist'
        //            )
        //        );

        //  $playlist = $this->formatPlaylists(new Collection($playlist));
        return response()->json(['data' => $playlist]);
    }

    public function getPlaylistItems(Request $request)
    {
        $playlistId = $request->get('playlist_id');
        $playlist = UserPlaylist::find($playlistId);
        if(!$playlist) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'Playlist not exists.',
                                    ], 404);
        }
        $items = UserPlaylistContent::query()
            ->where('user_playlist_id', $playlistId)
            ->orderBy('position', 'asc')
            ->get();
        $contentIds = $items->pluck('content_id');
        $parentIds = $items->pluck('content_parent')->filter();

        // Fetch Sanity and Assignment data
        $sanityData = $this->sanityGateway->getByRailContentIds($contentIds->toArray(), 'playlist-item');
        $assignmentsData = $this->sanityGateway->getAssignmentsByRailcontentIds(
            $playlist->brand,
            $contentIds->toArray(),
            $parentIds->toArray(),
            'playlist-item'
        );

        $sanityDataAssoc = collect($sanityData)->keyBy('railcontent_id');
        $assignmentDataAssoc = collect($assignmentsData)->keyBy('railcontent_id');
        $userPermissions = user()->getActivePermissionsIds();

        $mergedData = $items->map(function ($item) use ($sanityDataAssoc, $assignmentDataAssoc, $playlistId, $userPermissions) {
            return $this->formatPlaylistItemData($item, $sanityDataAssoc, $assignmentDataAssoc, $playlistId, $userPermissions);
        });

        return response()->json($mergedData);
    }

    /**
     * Update playlist item if it exists and belongs to the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePlaylistItem(Request $request){
        $validatedData = $request->validate([
                                                'start_second'        => 'nullable|numeric|min:0',
                                                'end_second'          => 'nullable|numeric|min:0',
                                                'playlist_item_name'  => 'nullable|string|max:255',
                                                'position'            => 'nullable|numeric|min:0'
                                            ]);

        $user = user();
        $playlistItemId = $request->get('user_playlist_item_id');
        $playlistItem = UserPlaylistContent::with('playlist')->find($playlistItemId);
        if(!$playlistItem){
            return response()->json([
                                        'success' => false,
                                        'error' => 'Item do not exists'
                                    ], 404);
        }

        // Check ownership and playlist existence
        if (!$playlistItem->playlist || ($playlistItem->playlist->user_id !== $user->id)) {
            return response()->json(['success' => false,
                                     'error' => 'You don’t have access to update items from this playlist'], 403);
        }

        // Handle position update if a new position is specified in the request
        if (isset($validatedData['position']) && $validatedData['position'] !== $playlistItem->position) {
            $newPosition = $validatedData['position'];
            $currentPosition = $playlistItem->position;

            if ($newPosition > $currentPosition) {
                // Move items between the current and new positions down by one
                UserPlaylistContent::where('user_playlist_id', $playlistItem->user_playlist_id)
                    ->whereBetween('position', [$currentPosition + 1, $newPosition])
                    ->decrement('position');
            } else {
                // Move items between the new and current positions up by one
                UserPlaylistContent::where('user_playlist_id', $playlistItem->user_playlist_id)
                    ->whereBetween('position', [$newPosition, $currentPosition - 1])
                    ->increment('position');
            }

            // Update the position of the current item
            $playlistItem->position = $newPosition;
        }

        // Update other fields in the playlist item
        $playlistItem->update($validatedData);

        return response()->json([
                                    'success' => true,
                                    'message' => 'Playlist item updated successfully'
                                ]);
    }

    public function removeItemFromPlaylist(Request $request)
    {
        $user = user(); // Assuming this function retrieves the current user
        $playlistItemId = $request->get('user_playlist_item_id');
        $playlistItem = UserPlaylistContent::with('playlist')->find($playlistItemId);
        if(!$playlistItem){
            return response()->json([
                                        'success' => false,
                                        'error' => 'Item do not exists'
                                    ], 404);
        }

        // Check if the user has access to the playlist
        if (!$playlistItem->playlist || ($playlistItem->playlist->user_id !== $user->id)) {
            return response()->json([
                                        'success' => false,
                                        'error' => 'You don’t have access to update items from this playlist'
                                    ], 403);
        }

        // Call the instance method to delete and reposition
        $deleted = $playlistItem->deletePlaylistItemAndReposition();

        if (!$deleted) {
            return response()->json([
                                        'success' => false,
                                        'error' => 'Failed to delete the playlist item.'
                                    ], 500);
        }

        return response()->json([
                                    'success' => true,
                                    'message' => 'Playlist item deleted successfully'
                                ]);
    }

    public function getPlaylistItem($playlistItemId, Request $request)
    {
        $user = user();
        $playlistItem = UserPlaylistContent::with('playlist')->find($playlistItemId);

        if(!$playlistItem){
            return response()->json([
                                        'success' => false,
                                        'error' => 'You don’t have access to item'
                                    ], 403);
        }

        // Check if the user has access to the playlist
        if (!$playlistItem->playlist || ($playlistItem->playlist->user_id !== $user->id)) {
            return response()->json([
                                        'success' => false,
                                        'error' => 'You don’t have access to items from this playlist'
                                    ], 403);
        }

        // Fetch Sanity and Assignment data for the specific item
        $sanityData = $this->sanityGateway->getByRailContentIds([$playlistItem->content_id], 'playlist-item');
        $assignmentsData = $this->sanityGateway->getAssignmentsByRailcontentIds(
            $playlistItem->playlist->brand,
            [$playlistItem->content_id],
            $playlistItem->content_parent ? [$playlistItem->content_parent] : [],
            'playlist-item'
        );

        $sanityDataAssoc = collect($sanityData)->keyBy('railcontent_id');
        $assignmentDataAssoc = collect($assignmentsData)->keyBy('railcontent_id');


        $userPermissions = user()->getActivePermissionsIds();

        $item = $this->formatPlaylistItemData($playlistItem, $sanityDataAssoc, $assignmentDataAssoc, $playlistItem->user_playlist_id, $userPermissions);
        return response()->json($item);
    }

    /**
     * @param \App\Modules\Content\Requests\AddItemToPlaylistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItemToPlaylists(AddItemToPlaylistRequest $request): JsonResponse
    {
        $extraParams = $request->only([
                                         'import_full_soundslice_assignment',
                                         'import_instrumentless_soundslice_assignment',
                                         'import_high_routine',
                                         'import_low_routine'
                                     ]);
        $flattenContent = $this->sanityGateway->countLessonsAndAssignments($request->get('content_id'));
        $itemsThatShouldBeAdd = ($flattenContent['lessons_count'] + count($extraParams)) ?? (count($extraParams));
        $importAllAssignments = $request->get('import_all_assignments', false);
        if ($importAllAssignments){
            $itemsThatShouldBeAdd += $flattenContent['soundslice_assignments_count'];
    }

        $extraData = [
            'import_full_soundslice_assignment' => json_encode(['is_full_track' => true]),
            'import_instrumentless_soundslice_assignment' => json_encode(['is_instrumentless_track' => true]),
            'import_high_routine' => json_encode(['is_high_routine' => true]),
            'import_low_routine' => json_encode(['is_low_routine' => true])
        ];

        $added = [];
        foreach ($request->get('playlist_id') as $playlistId){
            $playlist = UserPlaylist::with('items')->find($playlistId);
            if($playlist){
                if ($playlist->items->count() + $itemsThatShouldBeAdd > config('railcontent.playlist_items_limit', 300)) {
                    $limitExcedeed[] = $playlist;
                    continue;
                }
                $lastPosition = UserPlaylistContent::where('user_playlist_id', $playlistId)
                    ->max('position');
                foreach($extraParams as $key=>$value){
                    if($value) {
                        $lastPosition++;
                        $playlistItemData     = [
                            'content_id'       => $request->get('content_id'),
                            'content_parent'   => null,
                            'user_playlist_id' => $playlistId,
                            'position'         => $lastPosition,
                            'created_at'       => Carbon::now()->toDateTimeString(),
                            'extra_data'       => $extraData[$key],
                        ];
                        $playlistItem         = UserPlaylistContent::create($playlistItemData);
                        $added[$playlistId][] = $playlistItem->id;
                    }
                }
                if(empty($extraParams)) {
                    foreach ($flattenContent['lessons'] as $item) {
                        $lastPosition++;
                        $playlistItemData = [
                            'content_id'       => $item['id'],
                            'content_parent'   => $item['parent_id'],
                            'user_playlist_id' => $playlistId,
                            'position'         => $lastPosition,
                            'created_at'       => Carbon::now()->toDateTimeString(),
                        ];
                        $playlistItem     = UserPlaylistContent::create($playlistItemData);
                        $added[$playlistId][] = $playlistItem->id;
                        if($importAllAssignments){
                            foreach ($flattenContent['soundslice_assignments'][$item['id']]??[] as $item) {
                                $lastPosition++;
                                $playlistItemData = [
                                    'content_id'       => $item['id'],
                                    'content_parent'   => $item['parent_id'],
                                    'user_playlist_id' => $playlistId,
                                    'position'         => $lastPosition,
                                    'created_at'       => Carbon::now()->toDateTimeString(),
                                ];
                                $playlistItem = UserPlaylistContent::create($playlistItemData);
                                $added[$playlistId][] = $playlistItem->id;
                            }
                        }
                    }
                }
                event(new PlaylistItemsUpdated($playlistId));
            }
        }
        $results = [
            'success' => true,
        ];
        if (isset($limitExcedeed)) {
            $results['limit_excedeed'] = $limitExcedeed;
        }

        $results['successful'] = $added;

        return response()->json($results);
    }

    /**
     * @param $id
     * @return array
     */
    public function countLessonsAndAssignments($id):array
    {
        return $this->sanityGateway->countLessonsAndAssignments($id);
    }


    /**
     * Format the playlists with durations and URLs.
     *
     * @param array $playlists The playlists to format.
     * @return array The formatted playlists.
     */
    private function formatPlaylists(array $playlists): array
    {
        foreach ($playlists as $index => $playlist) {
            $minsec                                 = gmdate("i:s", $playlists[$index]['duration'] ?? 0);
            $hours                                  = (gmdate("d", $playlists[$index]['duration'] ?? 0) - 1) * 24 + gmdate("H", $playlists[$index]['duration'] ?? 0);
            $playlists[$index]['duration_formated'] = ($hours == 0) ? $minsec : $hours . ':' . $minsec;
            $playlists[$index]['url']               =
                url()->route('platform.user.playlist', ["id" => $playlist['id'], "brand" => brand()]);

            $playlists[$index]['playback_url'] = url()->route('platform.play.playlist', [
                'playlistId' => $playlist['id'],
            ]);

            $playlists[$index]['description'] = ($playlist['description']) ? $playlist['description'] : '';
            $playlists[$index]['total_items'] = count($playlist['items']);
        }

        return $playlists;
    }

    /**
     * Helper function to format playlist item data with Sanity and Assignment info.
     *
     * @param UserPlaylistContent $item
     * @param Collection $sanityDataAssoc
     * @param Collection $assignmentDataAssoc
     * @param int $playlistId
     * @return array
     */
    private function formatPlaylistItemData($item, $sanityDataAssoc, $assignmentDataAssoc, $playlistId, $userPermissions)
    {
        $sanityInfo = $sanityDataAssoc->get($item->content_id);
        $assignmentInfo = $assignmentDataAssoc->get($item->content_id);

        // Process route information if it exists in Sanity data
        $route = [];
        if (!empty($sanityInfo['parent_content_data'] ?? [])) {
            $route = collect($sanityInfo['parent_content_data'])->map(function ($parent) {
                switch ($parent['type']) {
                    case 'learning-path':
                        return 'Method';
                    case 'learning-path-level':
                        return 'L' . $parent['position'];
                    case 'foundation':
                        return 'Method';
                    default:
                        return $parent['slug'];
                }
            })->toArray();
            $sanityInfo['route'] = array_reverse($route);
        }

        $item->thumbnail_url = $assignmentInfo ? $assignmentInfo['thumbnail'] : ($sanityInfo['thumbnail'] ?? null);
        $item->item_type = $item->type = $assignmentInfo ? $assignmentInfo['item_type'] : ($sanityInfo['type'] ?? null);
        $item->user_playlist_item_extra_data = $sanityInfo['extra_data'] ?? null;
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

        $data = array_merge($item->toArray(), $sanityInfo ?? [], $assignmentInfo ?? []);
        $data['need_access'] = empty(array_intersect($userPermissions, $data['permission_id']));
        if (!empty($data['extra_data'])) {
            foreach (json_decode($data['extra_data'], true) ?? [] as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
