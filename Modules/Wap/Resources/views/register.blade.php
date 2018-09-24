<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>注册</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body class="searchbg">
<div id="app">
    <div class="head_com">
        <div class="hederbg">
            <a href="javascript:history.go(-1)" class="backIcon"></a>
            <h1>注册</h1>
        </div>
    </div>
    <div class="topjiange"></div>
    <div class="form-control">
        <form action="/wap/registerHandle" method="post" id="register">
            {{csrf_field()}}
            <div class="register-row">
                <i class="registerIcon telIcon"></i>
                <input type="text" placeholder="请输入手机号" v-model="register.phone" @keyup.enter="register" name="phone"
                       value="">
            </div>
            <div class="register-row">
                <i class="registerIcon codeIcon"></i>
                <input type="text" placeholder="请输入验证码" name="captcha" v-model="register.captcha"
                       @keyup.enter="register" value="">
                <img id="captcha" onclick="this.src='{{captcha_src('flat')}}'+Math.random()" style="width:105px"
                     src="{{captcha_src('flat')}}" class="codepng" alt="">
            </div>
            <div class="register-row">
                <i class="registerIcon codeIcon"></i>
                <input type="password" placeholder="请输入手机短信验证码" v-model="register.sms" @keyup.enter="register"
                       name="sms" value="">
                <input type="button" class="sendbtn" id="btn" name="" @click="getCode" value="发送验证码">
            </div>
            <div class="register-row">
                <i class="registerIcon passIcon"></i>
                <input type="password" placeholder="请输入密码" v-model="register.password" name="password"
                       @keyup.enter="register" value="">
            </div>
            <div class="register-row">
                <i class="registerIcon passIcon"></i>
                <input type="password" placeholder="请再次输入密码" v-model="register.password_confirmation"
                       name="password_confirmation" @keyup.enter="register" value="">
            </div>
            <div class="form-ms"></div>
            <div class="form-btn">
                <span @click="registersub">注册</span>
            </div>
        </form>
    </div>
    <div class="form-control" style="display: none;">
        <div class="form-succ"><img src="/mobile/images/succ.png" alt=""></div>
        <div class="form-msg">注册成功</div>
        <div class="form-btn">
            <span>确认</span>
        </div>
    </div>
</div>
<script>
    var token = '{{csrf_token()}}';
    @if(count($errors)>0)
    layer.msg('{{$errors->first()}}');
    @endif
</script>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/register.js "></script>
<script type="text/javascript">
    mui.init();
</script>
</body>
</html>