<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Models\UserPlaylist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Services\PlaylistsService;

class PlaylistsMetadataController extends Controller
{
    public function __construct(
        private PlaylistsService $playlistsService)
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
