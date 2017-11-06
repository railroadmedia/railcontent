<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\RemoteStorageService;

class RemoteStorageJsonController
{
    /**
     * @var RemoteStorageService
     */
    private $remoteStorageService;

    public function __construct(RemoteStorageService $remoteStorageService)
    {
        $this->remoteStorageService = $remoteStorageService;
    }

    public function put(Request $request)
    {
        $target = $request->get('target');

        if ($this->remoteStorageService->put($target, $request->file('file'))) {
            return new JsonResponse(
                'https://' . config('railcontent.awsCloudFront') . '/' . $target, 201
            );
        }

        return new JsonResponse('RemoteStorageService@put failed', 400);
    }
}