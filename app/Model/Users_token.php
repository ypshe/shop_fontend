<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users_token extends Model
{
    protected $table = 'shop_users_token';

    public $timestamps = false;

    public function token()
    {
        return $this->hasOne('Ap\Model\Token', 'id', 'token_id');
    }

    public static function getUserToken($uid, $agent_id)
    {
        $tokens = self::where('user_id', $uid)
            ->where('agent_id', $agent_id)
            ->where('status', 0)
            ->where('expire_date', '>', date('Y-m-d H:i:s'))
            ->get();
        if (!$tokens) {
            return [];
        }
        $data = [];
        foreach ($tokens as $token) {
            $data[] = $token->token;
        }
        return $data;
    }

}
