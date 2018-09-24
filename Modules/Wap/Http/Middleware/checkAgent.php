<?php

namespace Modules\Wap\Http\Middleware;

use App\Http\Controllers\ErrorController;
use App\Model\Agent_shop;
use App\Model\Agents;
use App\Model\Shop_user;
use App\Model\System;
use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Support\Facades\Auth;

class checkAgent extends Middleware
{
    public function handle($request, Closure $next)
    {
        $agent_id = 0;
        if (!session('agent_id')) {
            $path = $request->getPathInfo();
            try {
                if (strpos($path, 'A_') !== false) {
                    preg_match('/A_[0-9]/', $path, $res);
                    $agent_id = explode('A_', $res[0])[1];
                }
                if (Auth::check()) {
                    $agent_id = $this->checkDefaultAgent($agent_id);
                } else {
                    if (!$agent_id) {
                        $data = [
                            'message' => '请先登陆！',
                            'url' => '/wap/login'
                        ];
                        return response()->view('wap::404', $data, 200);
                    }
                }
            } catch (\Exception $e) {
                $data = [
                    'message' => '操作有误！code[1002]' . $e,
                    'url' => '/wap/login'
                ];
                return response()->view('wap::404', $data, 200);
            }
        }else {
            $agent_id = session('agent_id');
        }
        if (!Agents::find($agent_id)) {
            $data = [
                'message' => '操作有误！code[1001]',
                'url' => '/wap/login'
            ];
            return response()->view('wap::404', $data, 200);
        }
        if (!Agent_shop::where('agent_id', $agent_id)->where('status', 1)->first()) {
            $system = System::first();
            $message = $system ? '如有疑问请联系<a href="tel:' . $system->mobile . '">系统管理员</a>，联系电话<a href="tel:' . $system->mobile . '">' . $system->mobile . '</a>' : '';
            $data = [
                'message' => '商城被停用！' . $message,
                'url' => ''
            ];
            return response()->view('wap::404', $data, 200);
        }
        session(['agent_id' => $agent_id]);
        \Session::put('agent_id', $agent_id);
        return $next($request);
    }

    private function checkDefaultAgent($agent_id)
    {
        $user = Auth::user();
        $shop_user = Shop_user::where('user_id', $user->id)->where('is_default', 1)->first();
        if ($shop_user && $shop_user->agent_id != $agent_id) {
            Shop_user::where('id', $shop_user->id)->update(['is_default' => 0]);
            Shop_user::where('user_id', $user->id)->where('agent_id', $agent_id)->update(['is_default' => 1]);
            $agent_id = $shop_user->agent_id;
        } else {
            if (!Shop_user::where('user_id', $user->id)->where('agent_id', $agent_id)->first() && $agent_id != 0) {
                Shop_user::insert([
                    'is_default' => 1,
                    'agent_id' => $agent_id,
                    'user_id' => $user->id
                ]);
            } else {
                $shop_user = Shop_user::where('user_id', $user->id)->first();
                if ($shop_user) {
                    Shop_user::where('id', $shop_user->id)->update(['is_default' => 1]);
                    return $shop_user->agent_id;
                }
            }
        }
        return $agent_id;
    }

}
