<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
