<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vimeo\Vimeo;

class AdminController extends Controller
{
    public function vimeoData(Request $request)
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


}
