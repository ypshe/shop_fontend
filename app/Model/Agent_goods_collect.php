<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Agent_goods_collect extends Model
{
    protected $table = 'agent_goods_collect';

    public $timestamps = false;

    public function good()
    {
        return $this->hasOne('App\Model\Goods', 'agent_goods_id', 'agent_goods_id');
    }

}
