<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Entities\Entity;
use Railroad\Railcontent\Services\RemoteStorageService;
use Railroad\Railcontent\Transformers\DataTransformer;

class RemoteStorageJsonController extends Controller
{
    /**
     * @var RemoteStorageService
     */
    private $remoteStorageService;

    /**
     * RemoteStorageJsonController constructor.
     *
     * @param RemoteStorageService $remoteStorageService
     */
    public function __construct(RemoteStorageService $remoteStorageService)
    {
        $this->remoteStorageService = $remoteStorageService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function put(Request $request)
    {
        $target = $request->get('target');

        if ($this->remoteStorageService->put($target, $request->file('file'))) {
            return reply()->json(
                new Entity(['url' => 'https://' . config('railcontent.awsCloudFront') . '/' . $target]),
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