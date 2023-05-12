<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManifestFilesController extends BaseController
{
    public function drumeoManifestFile()
    {
        return file_get_contents(public_path('/favicons/drumeo/manifest.json'));
    }

    public function rootManifestFile()
    {
        if (Str::endsWith(request()->host(), 'drumeo.com')) {
            return redirect()->to('/favicons/drumeo/manifest.json');
        } elseif (Str::endsWith(request()->host(), 'pianote.com')) {
            return redirect()->to('/favicons/pianote/site.webmanifest');
        } elseif (Str::endsWith(request()->host(), 'guitareo.com')) {
            return redirect()->to('/favicons/guitareo/site.webmanifest');
        } elseif (Str::endsWith(request()->host(), 'singeo.com')) {
            return redirect()->to('/favicons/singeo/site.webmanifest');
        }

        throw new NotFoundHttpException();
    }

    public function brandManifestFile($brand)
    {
        return file_get_contents(public_path('/favicons/' . $brand . '/site.webmanifest'));
    }

    public function appleAssociationFile()
    {
        $json = file_get_contents(base_path('apple-app-site-association'));
        return response($json, 200)
                ->header('Content-Type', 'application/json');
    }

    public function androidAssociationFile()
    {
        $json = file_get_contents(base_path('assetlinks'));
        return response($json, 200)
            ->header('Content-Type', 'application/json');
    }
}
