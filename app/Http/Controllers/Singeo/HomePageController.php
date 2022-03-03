<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function show() 
    {
        return view('singeo.home');
    }
}  