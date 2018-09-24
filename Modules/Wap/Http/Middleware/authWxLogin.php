<?php

namespace Modules\Wap\Http\Middleware;

use App\Model\Users;
use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;
use App\Admin\Model\User;

class authWxLogin extends Middleware
{

    public function handle($request, Closure $next)
    {
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            if (!Auth::check()) {
                $user = session('wechat.oauth_user.default');
                if (!$user) {
                    try {
                        $user = app('wechat.official_account')->oauth->user();
                        session(['wechat.oauth_user.default' => $user]);
                    } catch (\Exception $e) {

                    }
                }
                if (!$user) {
                    $app = app('wechat.official_account');
                    return $app->oauth->scopes(['snsapi_userinfo'])
                        ->redirect();
                } else {
                    $userData = User::where('wx_openId', $user->id)->first();
                    if (!$userData) {
                        return response()
                            ->view('Mobile.error', ['msg' => '请先绑定手机号与登录密码！如果没有请注册！', 'type' => 'error', 'url' => '/wap/login/wx'], 200);
                    } else {
                        if ($userData->wx_openId !== $user->id) {
                            return response()
                                ->view('Mobile.error', ['msg' => '系统检测到该手机号存在绑定的微信号，如需更换绑定请先到原微信号解除绑定！', 'type' => 'error', 'url' => '/wap/login/wx'], 200);
                        }
                        Auth::loginUsingId($userData->id);
                        Users::updateLoginIp($userData->id, $request->getClientIp());
                    }
                }
            }
        }
        return $next($request);
    }
}
