<?php

namespace Modules\Wap\Http\Controllers;


class SearchController extends Controller
{
    public function index()
    {
        return view('wap::search');
    }
}