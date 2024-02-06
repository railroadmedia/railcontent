<?php

namespace App\Modules\MusoraApi\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LearningController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function hideLearningPaths(Request $request)
    {
        ['brand' => $brand] = $request->validate([
            'brand' => 'required',
        ]);

        $userAttribute = $brand . '_trial_section_hide';
        user()->{$userAttribute} = true;
        user()->save();

        return response(json_encode(user()), 200);
    }
}
