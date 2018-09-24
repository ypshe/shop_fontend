<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    protected $table = 'users';

    public static function updateLoginIp($id, $ip)
    {
        $data = [
            'last_login_time' => date('Y-m-d H:i:s'),
            'last_login_ip' => ip2long($ip)
        ];
        return self::where('id', $id)->update($data);
    }

    public static function updatePwd($id, $password)
    {
        return self::where('id', $id)->update(['password' => Hash::make($password)]);
    }
}
