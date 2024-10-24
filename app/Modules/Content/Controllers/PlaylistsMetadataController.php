<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use App\Modules\Content\Models\UserPlaylistLike;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Services\PlaylistsService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Transformers\DataTransformer;

class PlaylistsMetadataController extends Controller
{
    public function __construct(
        private PlaylistsService $playlistsService,
        private SanityGateway $sanityGateway)
    {
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
            ->when(!is_null($brand), fn($query) => $query->ofBrand($brand))
            ->forPage($page, $limit)
            ->searchTerm($request->get('term'))
            ->sortBy($orderByColumn, $orderByDirection)
            ->get();

        // Formatting durations and URLs for playlists
        $playlists = $this->formatPlaylists($playlists);

        // Total results count
        $totalResults = UserPlaylist::query()
            ->where('railcontent_user_playlists.user_id', $user->id)
            ->when(!is_null($brand), fn($query) => $query->ofBrand($brand))
            ->searchTerm($request->get('term'))
            ->count();

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

    public function duplicatePlaylist(Request $request)
    {
        $playlistId = $request->get('playlist_id');
        $user = user();
        $originalPlaylist = UserPlaylist::with('items')->findOrFail($playlistId);

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

    public function deletePlaylistWithItems(Request $request)
    {
        $playlistId = $request->get('playlist_id');
        $playlist = UserPlaylist::findOrFail($playlistId);
        // Ensure the authenticated user is the owner of the playlist
        if ($playlist->user_id !== user()->id) {
            return response()->json(['error' => 'You don’t have access to delete this playlist.'], 403);
        }

        $playlist->items()->delete();  // Deletes all related playlist items
        $playlist->delete();  // Deletes the playlist

        return response()->json(['message' => 'Playlist and associated items deleted successfully.']);
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
        $playlist = UserPlaylist::findOrFail($playlistId);
        if ($playlist->user_id !== user()->id) {
            return response()->json(['error' => 'You don’t have access to update this playlist'], 403);
        }

        // Update the playlist with validated data
        $playlist->update($validatedData);

        return response()->json([
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
            'thumbnail_url'=> $validatedData['thumbnail_url'] ?? null,
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
            ->first();

        if ($existingLike) {
            return response()->json([
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
                                        'message' => 'You have not liked this playlist.',
                                    ], 404);
        }

        // Delete the like
        $like->delete();

        return response()->json([
                                    'message' => 'Playlist like removed successfully.',
                                ], 200);
    }

    public function getPlaylist(Request $request)
    {
        $user = user();
        $playlistId = $request->get('playlist_id');
        $playlist = UserPlaylist::findOrFail($playlistId);
        throw_if(!$playlist, new NotFoundException("Playlist not exists."));

        throw_if(
            ($playlist->user_id != $user->id && $playlist->private == true),
            new NotFoundException("You don’t have access to this playlist", 'Private Playlist')
        );
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
        $items = UserPlaylistContent::query()
            ->where('user_playlist_id', $playlistId)
            ->get();
        $contentIds = $items->pluck('content_id');
        $sanityData = $this->sanityGateway->getByRailContentIds($contentIds->toArray());
        $sanityDataAssoc = collect($sanityData)->keyBy('railcontent_id');
        $mergedData = $items->map(function ($item) use ($sanityDataAssoc) {
            $sanityInfo = $sanityDataAssoc->get($item->content_id);
            return array_merge(
                $item->toArray(),
                $sanityInfo ? $sanityInfo : []
            );
        });

        return response()->json($mergedData);
    }

    /**
     * Format the playlists with durations and URLs.
     *
     * @param array $playlists The playlists to format.
     * @return array The formatted playlists.
     */
    private function formatPlaylists(Collection $playlists): Collection
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
            $playlists[$index]['total_items'] = $playlist->items->count();
        }

        return $playlists;
    }
}
