<?php
/**
 * Created by PhpStorm.
 * User: Mr.she
 * Date: 2018/9/4
 * Time: 22:05
 */

namespace App\Model;


class Tools
{
    public static function getAgentId($agent)
    {
        preg_match('/A_[0-9]/', $agent, $res);
       return explode('A_', $res[0])[1];
    }
}