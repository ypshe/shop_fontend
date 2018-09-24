<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class ErrorController extends Controller
{
    public static function msg($data){
        return view('wap::404')->with($data);
    }
}
