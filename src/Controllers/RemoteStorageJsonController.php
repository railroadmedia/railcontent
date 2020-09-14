<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\RemoteStorageService;

/**
 * Class RemoteStorageJsonController
 *
 * @package Railroad\Railcontent\Controllers
 *
 * @group Remote storage API
 */
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
            return response()->json(
                ['data' => [['url' => 'https://' . config('railcontent.aws_cloud_front_url_prefix') . '/' . $target]]],
                201
            );
        }

        return response()->json(['message' => 'RemoteStorageService@put failed'], 400);
    }
}