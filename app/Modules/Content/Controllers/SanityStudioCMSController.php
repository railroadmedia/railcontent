<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Models\Sanity\Artist;
use App\Modules\Content\Models\Sanity\Event;
use App\Modules\Content\Models\Sanity\Genre;
use App\Modules\Content\Models\Sanity\Permission;
use App\Modules\Content\Models\Sanity\Post;
use App\Modules\Content\Models\Sanity\Resource;
use App\Modules\Content\Models\Sanity\Song;
use App\Modules\Content\Models\Sanity\Soundslice;
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
        $types = [(new Song())->toArray(), (new Artist())->toArray(), (new Genre())->toArray(), (new Soundslice())->toArray(), (new Resource())->toArray(), (new Permission())->toArray()];

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

    public function customInput(){
        $json = file_get_contents(public_path('/platform/js/CustomInput.js'));

        return response($json, 200)
            ->header('Content-Type', 'text/javascript');
    }
}
