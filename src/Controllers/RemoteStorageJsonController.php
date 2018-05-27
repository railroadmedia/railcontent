<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\RemoteStorageService;

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

        if ($this->remoteStorageService->put($target, $request->file('file'))) {
            return new JsonResponse(
                'https://' . config('railcontent.awsCloudFront') . '/' . $target, 201
            );
        }

        return new JsonResponse('RemoteStorageService@put failed', 400);
    }
}