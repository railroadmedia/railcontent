<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentModerationController extends BaseController
{
    public function comments()
    {
        if (!user()->isAdmin()) {
            throw new NotFoundHttpException();
        }

        return view('content.comments');
    }
}
