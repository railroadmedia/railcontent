<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteMapController extends BaseController
{
    public function sitemap(Request $request)
    {
        $root = $request->root();
        if (str_contains($root, 'drumeo.com')) {
            return file_get_contents(resource_path('/sitemap/drumeo/sitemap.xml'));
        }

        abort(404);
    }
}
