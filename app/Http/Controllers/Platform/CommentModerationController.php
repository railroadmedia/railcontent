<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentModerationController extends BaseController
{
    public function comments(): View
    {
        if (!user()->isAdmin()) {
            throw new NotFoundHttpException();
        }

        return view('content.comments');
    }
}
