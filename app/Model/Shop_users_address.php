<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop_users_address extends Model
{
    protected $table = 'shop_users_address';

    public $timestamps = false;

    public static function getAddress($user_id)
    {
        $data = self::where('user_id', $user_id)->orderBy('is_default', 'desc')->get();
        if (!$data) return [];
        $res = [];
        foreach ($data->toArray() as $item) {
            $res[] = [
                'name' => $item['addressee'],
                'id' => $item['id'],
                'tel' => $item['mobile'],
                'address' => implode(' ', [
                    $item['country'],
                    $item['province'],
                    $item['city'],
                    $item['town'],
                    $item['address'],
                ]),
            ];
        }
        return $res;
    }

}
