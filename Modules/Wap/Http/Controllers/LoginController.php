<?php

namespace Modules\Wap\Http\Controllers;

use App\Model\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('wap::login');
    }

    public function loginHandle(Request $request)
    {
        $data = $request->except('_token');
        if (Auth::attempt(['mobile' => $data['mobile'], 'password' => $data['password']])) {
            $user = Users::where('mobile', $data['mobile'])->first();
            if (!$user) return redirect()->back()->with('message', '手机号未注册！');
            Auth::loginUsingId($user->id);
            Users::updateLoginIp($user->id, $request->getClientIp());
            if ($request->session()->has('needle_url')) {
                return response()->json(['status' => true, 'url' => $request->session()->get('needle_url')]);
            } else {
                return response()->json(['status' => true, 'url' => '/wap']);
            }
        }
        if (Users::where('mobile', $data['mobile'])->first()) {
            return response()->json(['status' => false, 'message' => '账号密码错误!']);
        }
        return response()->json(['status' => false, 'message' => '手机号未注册!']);
    }
}
