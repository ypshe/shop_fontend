<?php

namespace App\Http\Controllers;

use App\Exceptions\sendSms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Facades\Agent;

class IndexController extends Controller
{
    use sendSms;

    public function checkCaptcha(Request $request)
    {
        $validator = Validator::make($request->all('captcha'), [
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return \response()->json(['message' => '验证码错误！请重新输入！', 'status' => 'error']);
        }
        $phone = $request->get('phone');

        //发送短信
        $res = $this->sendSmsCode($phone);
        return response()->json($res);
    }

    public function index(){
        if(Agent::isMobile()){
            return redirect('/wap');
        }else{
            return redirect('/pc');
        }
    }

    public function logout(){
        Auth::logout();
        if(Agent::isMobile()){
            return redirect('/wap');
        }else{
            return redirect('/pc');
        }
    }
}
