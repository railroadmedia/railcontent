<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Railroad\Railcontent\Entities\Entity;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Transformers\DataTransformer;

class RemoteStorageJsonController extends Controller
{
    /**
     * @var RemoteStorageService
     */
    private $remoteStorageService;

    public function __construct(RemoteStorageService $remoteStorageService)
    {
        $this->remoteStorageService = $remoteStorageService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    public function put(Request $request)
    {
        $target = $request->get('target');
        if (Storage::disk('s3')->put($target, $request->file('file'))) {
            return reply()->json(
                new Entity(['url' => config('filesystems.disks.s3.cloudfront_access_url') . $target]),
                [
                    'transformer' => DataTransformer::class,
                    'code' => 201,
                ]
            );
        }
        return reply()->json(
            new Entity(['message' => 'RemoteStorageService@put failed']),
            [
                'transformer' => DataTransformer::class,
                'code' => 400,
            ]
        );
    }
}