<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class MobileAppStoreAPIKeyFilesController extends BaseController
{
    public function drumeoGooglePlayAPIJSONFile(): Response
    {
        $json = file_get_contents(base_path('drumeo-google-play-api.json'));

        return response($json, 200)
            ->header('Content-Type', 'application/json');
    }

    public function pianoteGooglePlayAPIJSONFile(): Response
    {
        $json = file_get_contents(base_path('pianote-google-play-api.json'));

        return response($json, 200)
            ->header('Content-Type', 'application/json');
    }
}
