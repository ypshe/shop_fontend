<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'agent_goods';

    public $timestamps = false;

    public $primaryKey = 'agent_goods_id';

    public static function getSaleGood($agent_id, $limit = 0)
    {
        $res = self::where('is_sale', 1)->where('status', 1)->where('agent_id', $agent_id);
        if ($limit) {
            $res = $res->limit($limit);
        }
        return $res->get()->toArray();
    }

    public static function getGoodsForIndex($agent_id, $page, $limit)
    {
        $res = self::select('name', 'wap_image as imgurl', 'agent_goods_id', 'sales_num as num', 'market_price as price')
            ->where('agent_id', $agent_id)
            ->where('status', 1)
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();
        //根据点击数排序
        $res = $res->sortByDesc('click_count');
        foreach ($res as &$value) {
            $value->imgurl = agents_path($value->imgurl);
            $value->href = url('/wap/goodDetail/' . $value->agent_goods_id);
        }
        return $res;
    }

    public static function getGoodDetail($good_id)
    {
        return self::find($good_id);
    }

    public function attr()
    {
        return $this->hasMany('App\Model\Goods_attr', 'agent_goods_id', 'agent_goods_id');
    }

    public function brand()
    {
        return $this->hasOne('App\Model\Goods_brand', 'id', 'brand_id');
    }

    public function cate()
    {
        return $this->hasOne('App\Model\Goods_cate', 'id', 'cate_id');
    }

    public static function collection($id, $type = 1)
    {
        if ($type) {
            self::where('agent_goods_id', $id)->increment('collection_num');
        } else {
            self::where('agent_goods_id', $id)->decrement('collection_num');
        }
    }
}
