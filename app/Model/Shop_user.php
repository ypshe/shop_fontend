<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop_user extends Model
{
    protected $table = 'shop_users';

    public $timestamps = false;

    public function agent()
    {
        return $this->hasOne('Ap\Model\Agents', 'id', 'agent_id');
    }

}
