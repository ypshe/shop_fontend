<?php

namespace Modules\Wap\Http\Controllers;

use App\Model\Tools;
use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Toplan\Sms\Facades\SmsManager;

class RegisterController extends Controller
{

    public function index()
    {
        return view('wap::register');
    }

    public function register(Request $request)
    {
        $data = $request->except('_token', 'captcha');
        $validator = Validator::make($data, [
            'phone' => 'required|unique:users,mobile',
            'sms' => 'required|verify_code',
            'password' => 'required|confirmed',
        ], [
            'phone.required' => '手机号不能为空！',
            'sms.required' => '短信验证码不能为空！',
            'sms.verify_code' => '短信验证码错误！',
            'password.required' => '密码不能为空！',
            'password.confirmed' => '两次输入密码不相同！',
            'phone.unique' => '手机号已注册，请更换手机号或使用该账号登陆！',
        ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('sms.verify_code')) {
                //验证失败后建议清空存储的发送状态，防止用户重复试错
                SmsManager::forgetState();
            }
            return redirect()->back()->withErrors($validator);
        }
        $user = [
            'mobile' => $data['phone'],
            'password' => Hash::make($data['password']),
        ];
        $wx = session('wechat.oauth_user.default');
        if ($wx) {
            $user['wx_openId'] = $wx->id;
            $user['wx_name'] = $wx->nickname;
            $user['wx_pic'] = $wx->avatar;
        }
        try {
            $id = Users::insertGetId($user);
            if ($id) {
                Auth::loginUsingId($id);
                if ($request->session()->has('needle_url')) {
                    return redirect()->to($request->session()->get('needle_url'));
                } else {
                    $wap=new WapController();
                    return $wap->index();
                }
            }
        } catch (\Exception $e) {
            //nothing do
            dd($e);
        }
        $validator->errors()->add('code', '数据有误！');
        dd($validator);
        return redirect()->back()->withErrors($validator);
    }
}
