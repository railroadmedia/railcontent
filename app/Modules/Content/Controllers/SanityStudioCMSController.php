<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Models\Sanity\Artist;
use App\Modules\Content\Models\Sanity\Event;
use App\Modules\Content\Models\Sanity\Genre;
use App\Modules\Content\Models\Sanity\Permission;
use App\Modules\Content\Models\Sanity\Post;
use App\Modules\Content\Models\Sanity\Song;
use App\Modules\Content\Models\Sanity\Venue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request): Response
    {
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $basePath = '/admin/studio';

        // Day One
        // $types = [(new Artist())->toArray(), (new Venue())->toArray(), (new Event())->toArray()];
        // Musora
        $types = [(new Song())->toArray(), (new Artist())->toArray(), (new Genre())->toArray(), (new Permission())->toArray()];

        $schema = json_encode([
            'types' => $types
        ]);

        return response()->view(
            "content::sanity-studio-cms-index",
            compact([
                'projectId',
                'dataset',
                'basePath',
                'schema'
            ])
        );
    }

    public function getSoundsliceData(Request $request)
    {
        $slug = $request->get('slug');
        try {
            $client = new \GuzzleHttp\Client();
            $auth = [env('SOUNDSLICE_APP_ID'), env('SOUNDSLICE_SECRET')];
            $response = $client->request('GET', 'https://www.soundslice.com/'.'api/v1/slices/'.$slug.'/recordings', [
                'auth' => $auth,
            ]);

            $body = json_decode($response->getBody(), true);
            $duration = 0;
            if (!empty($body)) {
                $duration = \Arr::last($body)['cropped_duration'] ?? \Arr::first($body)['cropped_duration'] ?? 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
        return $duration;
    }
}
