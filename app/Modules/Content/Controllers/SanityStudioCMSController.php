<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\Sanity\Artist;
use App\Modules\Content\Models\Sanity\Event;
use App\Modules\Content\Models\Sanity\Genre;
use App\Modules\Content\Models\Sanity\Permission;
use App\Modules\Content\Models\Sanity\Post;
use App\Modules\Content\Models\Sanity\Song;
use App\Modules\Content\Models\Sanity\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Railroad\Railcontent\Events\ContentCreated;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request): Response
    {
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $basePath = '/admin/studio';
        $csrfToken = csrf_token();
        $appUrl = env('APP_URL');

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
                'schema',
                'csrfToken',
                'appUrl'
            ])
        );
    }

    public function getSoundsliceDuration(Request $request)
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

    public function getLastContent(Request $request): Content
    {
        $content = Content::query()
            ->where('type', '=', 'song')
            ->where('slug', '=', $request->get('slug')['current'])
            ->first();

        if (!$content) {
            $content         = new Content();
            $content->type   = $request->get('_type');
            $content->slug   = $request->has('slug') ? $request->get('slug')['current'] : null;
            $content->language   = 'en-US';
            $content->created_on = Carbon::now()->toDateTimeString();
            $content->status = 'published';
            $content->brand  = $request->get('brand');

            $content->save();
        }

        $content->status = 'published';
        $content->brand  = $request->get('brand');
        $content->setTitle($request->get('title'));
        $content->setDifficulty($request->get('difficulty'));
        $content->setXP($request->get('xp'));
        $content->setReleased($request->get('released'));
        $content->setAlbum($request->get('album'));

        $content->save();

        event(new ContentCreated($content->id));

        $content = Content::query()
            ->where('type', '=', 'song')
            ->where('slug', '=', $request->get('slug')['current'])
            ->first();

        return $content;
    }
}
