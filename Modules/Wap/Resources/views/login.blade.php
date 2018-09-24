<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>绑定手机号</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body class="searchbg">
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="javascript:history.go(-1)" class="backIcon"></a>
                <h1>绑定手机号</h1>
                <a href="{{url('/wap/register')}}" class="sousuo">注册</a>
            </div>
        </div>
        <div class="topjiange"></div>   
        <div class="login_logo"><img src="/mobile/images/logo.png" alt=""></div>
        <div class="login_form">
            <div class="login_row">
                <i class="bdIcon telIcon"></i>
                <input type="text" name="" value="" v-model="loginfrom.tel" @keyup.enter="login" placeholder="请输入手机号">
            </div>
            <div class="login_row">
               <i class="bdIcon passIcon"></i>
                <input type="password" name="" value="" v-model="loginfrom.pass" @keyup.enter="login" placeholder="请输入密码">
            </div>
            <p><a href="ForgetPassword.html">忘记密码？</a></p>
            <div class="login_btn">
                <span @click="login">绑定</span>
            </div>
        </div>
    </div>
    <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/login.js "></script
</body>
</html>