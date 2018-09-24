<?php

namespace Modules\Wap\Http\Controllers;

use App\Model\Agent_ad;
use App\Model\Cate;
use App\Model\Goods;
use Illuminate\Http\Response;

class WapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['sale_good'] = Goods::getSaleGood($this->agent_id(), 6);
        $cate = Cate::getTopCate($this->agent_id());
        $data['cate'] = array_column($cate, 'name', 'id');
        $data['cate_width'] = 100 / count($data['cate']);
        $data['agent_id'] = $this->agent_id();
        $data['ad'] = Agent_ad::where('where', 'wap')->where('status', 1)->limit(3)->get();
        return view('wap::index')->with($data);
    }

}
