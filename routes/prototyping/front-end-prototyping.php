<?php

use Illuminate\Support\Facades\Route;

Route::get(
    '/prototype/{viewPath1}/{viewPath2?}/{viewPath3?}/{viewPath4?}/{viewPath5?}',
    function ($viewPath1, $viewPath2 = null, $viewPath3 = null, $viewPath4 = null, $viewPath5 = null) {
        $viewPath = $viewPath1;

        if (!empty($viewPath2)) {
            $viewPath .= '.'.$viewPath2;
        }
        if (!empty($viewPath3)) {
            $viewPath .= '.'.$viewPath3;
        }
        if (!empty($viewPath4)) {
            $viewPath .= '.'.$viewPath4;
        }
        if (!empty($viewPath5)) {
            $viewPath .= '.'.$viewPath5;
        }

        return view($viewPath);
    }
);
