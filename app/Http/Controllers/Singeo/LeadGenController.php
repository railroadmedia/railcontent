<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LeadGenController extends BaseController
{
    public function example(Request $request, $domain, $page = null)
    {
        switch ($page) {
            case null:
                return view('view.path');
            case 'page':
                return view('view.path');
        }

        throw new NotFoundHttpException();
    }
}
