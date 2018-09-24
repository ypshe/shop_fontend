<?php

namespace Modules\Wap\Http\Middleware;

use App\Http\Controllers\ErrorController;
use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Support\Facades\Auth;

class authMobile extends Middleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            $data = [
                'message' => '请先登录',
                'url' => '/wap/login'
            ];
            return response() ->view('wap::404', $data, 200);
        }
        return $next($request);
    }
}
