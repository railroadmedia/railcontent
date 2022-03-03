<?php

namespace App\Http\Controllers\Musora;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function show() 
    {
        return view('musora.pages.login');
    }
} 