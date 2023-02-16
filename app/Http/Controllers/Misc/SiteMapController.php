<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteMapController extends BaseController
{
    public function sitemap(Request $request)
    {
        $domain = $this->getDomain($request);
        try {
            $content = file_get_contents(resource_path("/sitemap/$domain/sitemap.xml"));
            return Response::make($content, 200)->header('Content-Type', 'text/xml');
        } catch (\Throwable $e) {
            throw new NotFoundHttpException();
        }
    }

    public function getDomain(Request $request): string
    {
        if (Str::endsWith(request()->host(), 'musora.com')) {
            return "musora";
        } elseif (Str::endsWith(request()->host(), 'drumeo.com')) {
            return "drumeo";
        } elseif (Str::endsWith(request()->host(), 'pianote.com')) {
            return "pianote";
        } elseif (Str::endsWith(request()->host(), 'guitareo.com')) {
            return "guitareo";
        } elseif (Str::endsWith(request()->host(), 'singeo.com')) {
            return "singeo";
        }
        throw new NotFoundHttpException();
    }
}
