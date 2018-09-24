<?php

namespace Modules\Wap\Http\Controllers;

use App\Model\Shop_users_address;
use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        return view('wap::user.index')
            ->with('user', $this->user());
    }

    public function edit()
    {
        return view('wap::user.edit')->with('user', $this->user());
    }

    public function editHandle(Request $request)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data, [
            'face' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ], [
                'face.required' => '请上传头像',
                'name.required' => '请填写昵称',
                'phone.required' => '请填写联系方式',
                'email.required' => '请填写电子邮箱',
                'email.email' => '电子邮箱格式不正确',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = $this->user();
        $data['face'] = $request->file('face')->store('/images/' . date('Ymd'), 'font');
        Users::where('id', $user->id)->update($data);
        $data = [
            'message' => '修改成功！',
            'url' => '/wap/user/set'
        ];
        return response()->view('wap::404', $data, 200);
    }

    public function set()
    {
        return view('wap::user.set')->with('user', $this->user());
    }

    public function collection()
    {
        return view('wap::user.collection');
    }

    public function coupon()
    {
        return view('wap::user.coupon');
    }

    public function address()
    {
        return view('wap::user.address');
    }

    public function addAddress(Request $request, $id = 0)
    {
        $path = $request->getPathInfo();
        if (strpos($path, 'addAddressByOrder') !== false) {
            $isByOrder = 1;
        } else {
            $isByOrder = 0;
        }
        $address = '';
        if ($id) {
            $address = Shop_users_address::find($id) ?: '';
        }
        return view('wap::user.addAddress')
            ->with('address', $address)
            ->with('isByOrder', $isByOrder);
    }

    public function selectAddress()
    {
        return view('wap::user.selectAddress');
    }

    public function addAddressHandle(Request $request)
    {
        $data = $request->except('_token', 'isByOrder');
        $isByOrder = $request->get('isByOrder');
        $validator = Validator::make($data, [
            'addressee' => 'required',
            'mobile' => 'required|regex:/^1[345678]\d{9}$/',
            'country' => 'required',
            'address' => 'required',
        ], [
                'addressee.required' => '请填写收件人',
                'mobile.required' => '请填写收件人电话',
                'mobile.regex' => '手机号码格式不正确',
                'country.required' => '请选择国家',
                'address.required' => '请填写具体地址',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'isByOrder' => $isByOrder]);
        }
        $data['user_id'] = $this->user()->id;
        if ($data['country'] == '泰国') {
            $data['province'] = '';
            $data['city'] = '';
            $data['town'] = '';
        }
        if (isset($data['id'])) {
            Shop_users_address::whereId($data['id'])->update($data);
            $res = $data['id'];
            $message = '修改';
        } else {
            $res = Shop_users_address::insertGetId($data);
            $message = '添加';
        }
        if ($data['is_default']) {
            Shop_users_address::where('id', '!=', $res)->update(['is_default' => 0]);
        }
        return response()->json(['status' => true, 'message' => $message . '地址成功！', 'isByOrder' => $isByOrder]);
    }

    public function accountSecurity()
    {
        return view('wap::user.accountSecurity');
    }

    public function changePhone()
    {
        return view('wap::user.changePhone');
    }

    public function changePassword(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('wap::user.changePassword');
        }
        $data = $request->except('_token');
        $user = $this->user();
        if (!Auth::attempt(['mobile' => $user->mobile, 'password' => $data['oldPassword']])) {
            return response()->json(['status' => false, 'message' => '原密码输入有误']);
        }
        $validator = Validator::make($data, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ], [
                'oldPassword.required' => '请填写原密码',
                'password.required' => '请填写新密码',
                'password.confirmed' => '两次输入密码不相同',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        Users::updatePwd($user->id, $data['password']);
        return response()->json(['status' => true, 'message' => '密码修改成功！']);
    }

    private static function user()
    {
        $user = Auth::user();
        return $user;
    }

    public static function getDefaultAddress()
    {
        $user = self::user();
        $defaultAddress = Shop_users_address::where('user_id', $user->id)->where('is_default', 1)->first();
        return $defaultAddress;
    }

}
