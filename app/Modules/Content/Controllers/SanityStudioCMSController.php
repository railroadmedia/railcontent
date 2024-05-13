<?php

namespace App\Modules\Content\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request)
    {
        $projectId = config('content.project_id');
        $dataset = config('content.dataset');
        $basePath = '/admin/studio';
        $schema = json_encode([
            'types' => [
                [
                    'type' => "document",
                    'name' => "post",
                    'title' => "Post",
                    'fields' => [
                        [
                            'type' => "string",
                            'name' => "title",
                            'title' => "Title"
                        ]
                    ]
                ]
            ]
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
