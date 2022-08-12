<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ManifestFilesController extends BaseController
{
    public function drumeoManifestFile()
    {
        return file_get_contents(public_path('/favicons/drumeo/manifest.json'));
    }

    public function rootManifestFile()
    {
        return file_get_contents(public_path('/favicon/site.webmanifest'));
    }

    public function brandManifestFile($brand)
    {
        return file_get_contents(public_path('/favicons/' . $brand . '/site.webmanifest'));
    }
}
