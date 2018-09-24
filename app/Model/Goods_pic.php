<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods_pic extends Model
{
    protected $table = 'agent_goods_pic';

    public $timestamps = false;

    public $primaryKey = 'img_id';

}
