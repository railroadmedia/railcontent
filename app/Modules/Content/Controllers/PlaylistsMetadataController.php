<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use App\Modules\Content\Models\UserPlaylistLike;
use App\Modules\Content\Requests\AddItemToPlaylistRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Services\PlaylistsService;

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
        $term = $request->get('term');
        $itemIdToCheck = $request->get('content_id');

        $results = $this->playlistsService->getPlaylists($sort, $brand, $term, $limit, $page, $itemIdToCheck);

        return response()->json($results);
    }

    /**
     * Duplicates an existing playlist and its associated items.
     *
     * This method creates a duplicate of an existing playlist, including its items. The new playlist is created
     * with the same attributes as the original, except for the name (which is appended with " (Duplicate)" by default),
     * and any attributes provided in the request. The new playlist is saved under the authenticated user’s ID.
     * The associated items of the original playlist are also duplicated and associated with the new playlist.
     *
     * @param int $playlistId The ID of the playlist to duplicate.
     * @param \Illuminate\Http\Request $request The HTTP request object, containing the optional updated values
     * for the duplicated playlist's name, description, category, thumbnail URL, and privacy.
     * @return \Illuminate\Database\Eloquent\Model The newly created duplicate playlist.
     */
    public function duplicatePlaylist(int $playlistId, Request $request)
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
        if (!$originalPlaylist) {
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

    /**
     * Deletes a playlist and all associated items for the authenticated user.
     *
     * This method finds a playlist by its ID and deletes it along with all the items related to that playlist.
     * It checks if the playlist exists and whether the authenticated user is the owner of the playlist before
     * proceeding with the deletion. If successful, it returns a response indicating that the playlist and its
     * items were deleted.
     *
     * @param int $playlistId The ID of the playlist to be deleted.
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the success or failure of the deletion.
     */
    public function deletePlaylistWithItems(int $playlistId, Request $request): JsonResponse
    {
        $playlist = UserPlaylist::find($playlistId);
        if (!$playlist) {
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

    /**
     * Updates an existing playlist for the authenticated user.
     *
     * This method validates the incoming request data for the playlist, including optional fields like name,
     * description, category, privacy setting, and thumbnail URL. If the playlist exists and belongs to the
     * authenticated user, it updates the playlist with the validated data and returns the updated playlist.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the playlist update data.
     * @param int $playlistId The ID of the playlist to be updated.
     * @return \Illuminate\Http\JsonResponse A JSON response with a success message, the updated playlist data,
     *                                      and a success status.
     */
    public function updatePlaylist(Request $request, int $playlistId): JsonResponse
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
        if (!$playlist) {
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

    /**
     * Creates a new playlist for the authenticated user.
     *
     * This method validates the incoming request data for the playlist, including fields like name, description,
     * category, thumbnail URL, privacy setting, and brand. After validation, a new playlist is created and saved
     * to the database with the provided data.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the playlist data.
     * @return \Illuminate\Http\JsonResponse A JSON response with a success message, the created playlist data,
     *                                      and a success status.
     */
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
            'user_id'      => user()->id,
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
                                    'success' => true,
                                ], 201);
    }

    /**
     * Adds a "like" to a playlist for the authenticated user.
     *
     * This method validates the provided playlist ID and checks if the user has already liked the playlist.
     * If the user has not liked the playlist, a new "like" is created and saved. If the user has already liked
     * the playlist, a message is returned indicating this.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the playlist ID and optional brand.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating whether the like was successfully added or not.
     */
    public function likePlaylist(Request $request): JsonResponse
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

    /**
     * Removes the "like" from a playlist for the authenticated user.
     *
     * This method validates the provided playlist ID and checks if the user has liked the playlist.
     * If a "like" is found, it is deleted. If the user has not liked the playlist, an error message is returned.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the playlist ID and brand.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating whether the like was successfully removed or not.
     */
    public function deletePlaylistLike(Request $request): JsonResponse
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

    /**
     * Retrieves a specific playlist based on the given playlist ID.
     *
     * This method checks if the playlist exists and whether the authenticated user has access to the playlist.
     * If the playlist is private and does not belong to the user, access is denied.
     * It also checks if the playlist is liked by the current user and formats the playlist data
     * before returning it in the response.
     *
     * @param int $playlistId The ID of the playlist to retrieve.
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the playlist data or an error message if the playlist doesn't exist or the user lacks access.
     */
    public function getPlaylist(int $playlistId, Request $request): JsonResponse
    {
        $user = user();
        $playlist = UserPlaylist::find($playlistId);
        if (!$playlist) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'Playlist not exists.',
                                    ], 404);
        }

        if ($playlist->user_id != $user->id && $playlist->private == true) {
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

        $playlist['is_liked_by_current_user'] = $playlist->likes()->where('user_id', $user->id)->exists();
        $playlist = $this->playlistsService->formatPlaylists([$playlist]);
        return response()->json(['data' => $playlist[0]]);
    }

    /**
     * Retrieves the items from a specified playlist.
     *
     * This method fetches the items of a playlist by first checking if the playlist exists.
     * If the playlist exists, it retrieves the items associated with the playlist using the
     * `playlistsService`. The method returns the playlist items in the response.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the playlist ID.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the playlist items or an error message if the playlist doesn't exist.
     */
    public function getPlaylistItems(Request $request): JsonResponse
    {
        $playlistId = $request->get('playlist_id');
        $playlist = UserPlaylist::find($playlistId);
        if (!$playlist) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'Playlist not exists.',
                                    ], 404);
        }
        $items = $this->playlistsService->getPlaylistItems($playlist->brand, $playlist->id);

        return response()->json($items);
    }

    /**
     * Updates a playlist item if it exists and belongs to the authenticated user.
     *
     * This method performs the following steps:
     * - Validates the provided data (start and end seconds, playlist item name, and position).
     * - Checks if the playlist item exists and belongs to the authenticated user.
     * - Updates the playlist item's position if a new position is provided, adjusting the position of other items as necessary.
     * - Updates the first item's thumbnail if the current item is moved to the first position.
     * - Updates the playlist item with the validated data (name, start and end times, position).
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the updated data for the playlist item.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the success or failure of the update operation.
     */
    public function updatePlaylistItem(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
                                                'start_second'        => 'nullable|numeric|min:0',
                                                'end_second'          => 'nullable|numeric|min:0',
                                                'playlist_item_name'  => 'nullable|string|max:255',
                                                'position'            => 'nullable|numeric|min:0'
                                            ]);

        $user = user();
        $playlistItemId = $request->get('user_playlist_item_id');
        $playlistItem = UserPlaylistContent::with('playlist')->find($playlistItemId);
        if (!$playlistItem) {
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

            if ($newPosition == 1) {
                $sanityData = $this->sanityGateway->getByRailContentIds([$playlistItem->content_id], 'playlist-item');
                //dd($sanityData[0]['thumbnail']);
                $playlistItem->playlist->first_item_thumbnail_url = $sanityData[0]['thumbnail'];
                $playlistItem->playlist->save();
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

    /**
     * Removes an item from a user's playlist and repositions remaining items.
     *
     * This method performs the following steps:
     * - Checks if the playlist item exists.
     * - Verifies that the user has access to modify the playlist item.
     * - Deletes the playlist item and repositions remaining items.
     * - If the removed item was the first item in the playlist, updates the thumbnail of the first item.
     * - Calls a service to update the playlist duration.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the playlist item ID.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating whether the operation was successful or not.
     */
    public function removeItemFromPlaylist(Request $request): JsonResponse
    {
        $user = user();
        $playlistItemId = $request->get('user_playlist_item_id');
        $playlistItem = UserPlaylistContent::with('playlist')->find($playlistItemId);
        if (!$playlistItem) {
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
        if ($playlistItem->position == 1) {
            $playlistItems =  UserPlaylistContent::query()->where('user_playlist_id', '=', $playlistItem->playlist->id)->orderBy('position', 'asc')->get();
            $firstItem  = $playlistItems->where('position', '=', 1)->first();
            $sanityData = $this->sanityGateway->getByRailContentIds([$firstItem->content_id], 'playlist-item');
            $assignmentsData = $this->sanityGateway->getAssignmentsByRailcontentIds(
                $firstItem->playlist->brand,
                [$firstItem->content_id],
                $firstItem->content_parent ? [$firstItem->content_parent] : [],
                'playlist-item'
            );
            $firstItemThumbnail = $sanityData[0]['thumbnail'] ?? $assignmentsData[0]['thumbnail'] ?? null;
            if ($firstItemThumbnail) {
                $playlistItem->playlist->first_item_thumbnail_url = $firstItemThumbnail;
                $playlistItem->playlist->save();
            }
        }
        $this->playlistsService->updateDuration($playlistItem->playlist);
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

    /**
     * Retrieves a specific playlist item and checks access permissions before returning the item data.
     *
     * The method performs the following tasks:
     * - Checks if the user has access to the playlist item.
     * - Verifies that the user has access to the playlist.
     * - Fetches related Sanity and Assignment data.
     * - Formats and returns the playlist item data with the necessary metadata.
     *
     * @param int $playlistItemId The ID of the playlist item to retrieve.
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the playlist item data or an error message if access is denied.
     */
    public function getPlaylistItem(int $playlistItemId, Request $request): JsonResponse
    {
        $user = user();
        $playlistItem = UserPlaylistContent::with('playlist')->find($playlistItemId);

        if (!$playlistItem) {
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
     * Adds items to the specified playlists, including lessons, assignments, and extra data based on the request.
     *
     * This method performs the following tasks:
     * - Counts lessons and assignments for the content.
     * - Checks if the playlists exceed the item limit.
     * - Adds items to the playlists, including extra data (e.g., soundslice assignments, routines).
     * - Updates the first item thumbnail and the playlist duration.
     *
     * If the total items exceed the playlist limit, the request will be skipped for that playlist.
     *
     * @param \App\Modules\Content\Requests\AddItemToPlaylistRequest $request The request containing playlist IDs, content ID, and additional parameters.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the success status and added items.
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
        if ($importAllAssignments) {
            $itemsThatShouldBeAdd += $flattenContent['soundslice_assignments_count'];
        }

        $extraData = [
            'import_full_soundslice_assignment' => json_encode(['is_full_track' => true]),
            'import_instrumentless_soundslice_assignment' => json_encode(['is_instrumentless_track' => true]),
            'import_high_routine' => json_encode(['is_high_routine' => true]),
            'import_low_routine' => json_encode(['is_low_routine' => true])
        ];

        $added = [];
        foreach ($request->get('playlist_id') as $playlistId) {
            $playlist = UserPlaylist::with('items')->find($playlistId);
            if (!$playlist) {
                continue;
            }

            if ($playlist->items->count() + $itemsThatShouldBeAdd > config('railcontent.playlist_items_limit', 300)) {
                $limitExcedeed[] = $playlist;
                continue;
            }
            $lastPosition = UserPlaylistContent::where('user_playlist_id', $playlistId)
                ->max('position');

            $isExtra = false;
            $firstItemInPlaylist = null;
            foreach ($extraParams as $key => $value) {
                if (!$value) {
                    continue;
                }
                $lastPosition++;
                if (!$firstItemInPlaylist) {
                    $firstItemInPlaylist = $flattenContent['lessons'][0];
                }
                $playlistItemData     = [
                    'content_id'       => $request->get('content_id'),
                    'content_parent'   => null,
                    'content_name'     => $flattenContent['lessons'][0]['title'],
                    'user_playlist_id' => $playlistId,
                    'position'         => $lastPosition,
                    'created_at'       => Carbon::now()->toDateTimeString(),
                    'extra_data'       => $extraData[$key],
                ];
                $playlistItem         = UserPlaylistContent::create($playlistItemData);
                $added[$playlistId][] = $playlistItem->id;
                $isExtra = true;
            }

            if (!$isExtra) {
                foreach ($flattenContent['lessons'] as $item) {
                    $lastPosition++;
                    if (!$firstItemInPlaylist) {
                        $firstItemInPlaylist = $item;
                    }

                    $playlistItemData = [
                        'content_id'       => $item['id'],
                        'content_parent'   => $item['parent_id'],
                        'content_name'     => $item['title'],
                        'user_playlist_id' => $playlistId,
                        'position'         => $lastPosition,
                        'created_at'       => Carbon::now()->toDateTimeString(),
                    ];
                    $playlistItem     = UserPlaylistContent::create($playlistItemData);
                    $added[$playlistId][] = $playlistItem->id;
                    if ($importAllAssignments) {
                        foreach ($flattenContent['soundslice_assignments'][$item['id']] ?? [] as $item) {
                            $lastPosition++;
                            if (!$firstItemInPlaylist) {
                                $firstItemInPlaylist = $item;
                            }

                            $playlistItemData = [
                                'content_id'       => $item['id'],
                                'content_parent'   => $item['parent_id'],
                               // 'content_name'     => $item['title'],
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
            if ($firstItemInPlaylist) {
                $playlist->first_item_thumbnail_url = $firstItemInPlaylist['thumbnail'];
                $playlist->save();
            }
            $this->playlistsService->updateDuration($playlist);

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
     * Counts the lessons and assignments for a specific entity identified by the given ID.
     *
     * This method calls the `countLessonsAndAssignments` method from the `sanityGateway` service to retrieve
     * the count of lessons and assignments associated with the entity specified by the ID.
     *
     * @param mixed $id The ID of the entity to count lessons and assignments for.
     * @return array An associative array containing the count of lessons and assignments.
     */
    public function countLessonsAndAssignments($id): array
    {
        return $this->sanityGateway->countLessonsAndAssignments($id);
    }

    /**
     * Fetches the pinned playlists for the user based on the provided brand.
     *
     * This method retrieves the brand from the request, and if not provided, it defaults to the brand set in the configuration.
     * It then calls the `getPinnedPlaylists` method in the `playlistsService` to retrieve the pinned playlists.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request, which contains the brand parameter.
     * @return array An array of pinned playlists retrieved from the playlists service.
     */
    public function getPinnedPlaylists(Request $request): array
    {
        $brand = $request->get('brand') ?? config('railcontent.brand');

        return $this->playlistsService->getPinnedPlaylists($brand);
    }

    /**
     * Pins a playlist to the user's playlist menu.
     *
     * This method first checks if the playlist exists. If the playlist does not exist, it returns a 404 response.
     * If the playlist is successfully pinned, it returns a success response.
     * If the user has already pinned the maximum allowed number of playlists, it returns an error response.
     *
     * @param int $playlistId The ID of the playlist to pin.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or failure.
     */
    public function pinPlaylist(int $playlistId): \Illuminate\Http\JsonResponse
    {
        $playlist = UserPlaylist::find($playlistId);
        if (!$playlist) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'Playlist not exists.',
                                    ], 404);
        }

        $pinned = $this->playlistsService->pinPlaylist($playlist);
        if($pinned == -1) {
            return response()->json(
                [
                    'success' => false,
                    'errors'  => [
                        [
                            'detail' => 'You can only pin five playlists to the menu. To add or remove a playlist, toggle
the pin icon on or off.',
                        ],
                    ],
                ],
                422
            );
        } else {
            return response()->json([
                                        'success' => true,
                                        'message' => 'Playlist pinned successfully',
                                    ], 201);
        }
    }

    /**
     * Unpins a playlist from the user's playlist menu.
     *
     * This method checks if the playlist exists. If it does not exist, a 404 response is returned.
     * If the playlist is successfully unpinned, a success response is returned.
     *
     * @param int $playlistId The ID of the playlist to unpin.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or failure.
     */
    public function unpinPlaylist(int $playlistId): \Illuminate\Http\JsonResponse
    {
        $playlist = UserPlaylist::find($playlistId);
        if (!$playlist) {
            return response()->json([
                                        'success' => false,
                                        'message' => 'Playlist not exists.',
                                    ], 404);
        }

        $this->playlistsService->unpinPlaylist($playlist);
        return response()->json([
                                    'success' => true,
                                    'message' => 'Playlist unpinned successfully',
                                ], 201);

    }

    /**
     * Helper function to format playlist item data with Sanity and Assignment info.
     *
     * This method takes in a playlist item and formats it by combining relevant data
     * from Sanity and Assignment sources, such as thumbnail, item type, instructors, and route.
     * It also checks whether the user has access to the content based on their permissions.
     *
     * @param \App\Models\UserPlaylistContent $item The playlist item to format.
     * @param \Illuminate\Support\Collection $sanityDataAssoc Associative array of Sanity data keyed by content ID.
     * @param \Illuminate\Support\Collection $assignmentDataAssoc Associative array of Assignment data keyed by content ID.
     * @param int $playlistId The ID of the playlist to which the item belongs.
     * @param array $userPermissions The user's active permissions for access control checks.
     * @return array The formatted playlist item data with additional details such as route, thumbnail, duration, etc.
     */
    private function formatPlaylistItemData( \App\Models\UserPlaylistContent $item,
        \Illuminate\Support\Collection $sanityDataAssoc,
        \Illuminate\Support\Collection $assignmentDataAssoc,
        int $playlistId,
        array $userPermissions): array
    {
        $sanityInfo = $sanityDataAssoc->get($item->content_id);
        $assignmentInfo = $assignmentDataAssoc->get($item->content_id);

        // Process route information if it exists in Sanity data
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
