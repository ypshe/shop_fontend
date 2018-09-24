<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users_cart extends Model
{
    protected $table = 'shop_users_cart';

    public $timestamps = false;

    public function good()
    {
        return $this->hasOne('App\Model\Goods', 'agent_goods_id', 'agent_goods_id');
    }

    public static function getCart($user_id)
    {
        return self::where('user_id', $user_id)->get();
    }

}
