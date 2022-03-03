<?php

namespace App\Http\Controllers\Drumeo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function show() 
    {
        return view('drumeo.home');
    }
}  