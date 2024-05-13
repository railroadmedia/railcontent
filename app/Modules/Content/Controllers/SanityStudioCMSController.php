<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Content\Models\Sanity\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request): Response
    {
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $basePath = '/admin/studio';

        $post = new Post();
        $schema = json_encode([
            'types' => [$post->toArray()]
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
}
