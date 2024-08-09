<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Modules\UserManagementSystem\Services\TestingService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mail;
use Redirect;
use Vimeo\Vimeo;

class AdminController extends Controller
{
    private TestingService $testingService;

    public function __construct(TestingService $testingService)
    {
        $this->testingService = $testingService;
    }

    public function vimeoData(Request $request): View
    {
        $ids = explode(',', $request->get('ids'));


        $client_id = config('railcontent.video_sync.vimeo.musora.client_id');
        $client_secret = config('railcontent.video_sync.vimeo.musora.client_secret');
        $access_token = config('railcontent.video_sync.vimeo.musora.access_token');
        $vimeo = new Vimeo($client_id, $client_secret);
        $vimeo->setToken($access_token);

        $data = [];
        foreach ($ids as $id) {
            $result = $vimeo->request("/videos/$id", [], 'GET');
            $sourceDownloadData = $this->getSourceDownloadData($result['body']['download']);
            $data[] = ['id' => $id, 'name' => $result['body']['name'], 'source_download' => $sourceDownloadData];
        }
        return view('pages.admin.vimeo-data', [
            'data' => $data
        ]);
    }

    public function getSourceDownloadData($downloads)
    {
        $sourceDownloadLink = null;
        for ($i = 0; $i < count($downloads); $i++) {
            if ($downloads[$i]['quality'] == 'source') {
                $sourceDownloadLink = [
                    'link' => $downloads[$i]['link'],
                    'size' => $downloads[$i]['size_short']
                ];
            }
        }
        return $sourceDownloadLink;
    }

    public function testEmail(Request $request)
    {
        $host = $request->host();
        Mail::raw('Hello World!', function ($msg) use ($host) {
            $msg->to('robert@musora.com')
                ->subject("Test Email: $host");
        });
    }

    public function createUser(Request $request): RedirectResponse
    {
        $productId = $request->get('productId');
        $createdAt = $request->get("createdAt");
        $user = $this->testingService->createTestUser($productId, $createdAt);
        return Redirect::to("musora-center#/users/$user->id");
    }


}
