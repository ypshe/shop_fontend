<?php

namespace Modules\Wap\Http\Controllers;


use App\Model\Users_cart;

class CarController extends Controller
{
    public function index()
    {
        return view('wap::car');
    }

}
