<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'agent_goods_cate';

    public $timestamps = false;

    public static function getTopCate($agent_id)
    {
        $res = self::select('wap_image','pc_image','name','id')
            ->where('level', 1)
            ->where('agent_id', $agent_id)
            ->get()
            ->toArray();
        return $res;
    }
}
