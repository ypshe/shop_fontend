<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>修改密码</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body class="searchbg">
<div id="app">
    <div class="head_com">
        <div class="hederbg">
            <a href="/wap/user/accountSecurity" class="backIcon"></a>
            <h1>修改密码</h1>
        </div>
    </div>
    <div class="topjiange"></div>
    <div class="form-control">
        <div class="form-row">
            <div class="form-label">原密码</div>
            <div class="form-input"><input type="password" name="oldPassword" value="" placeholder="原密码"></div>
        </div>
        <div class="form-row">
            <div class="form-label">新密码</div>
            <div class="form-input"><input type="password" name="password" value="" placeholder="新密码"></div>
        </div>
        <div class="form-row">
            <div class="form-label">再次输入密码</div>
            <div class="form-input"><input type="password" name="password_confirmation" value="" placeholder="再次输入密码">
            </div>
        </div>
        <div class="form-ms">密码由6-20位英文字母、数字或符号组成</div>
        <div class="form-btn" id="submit">
            <span>确认</span>
        </div>
    </div>
</div>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/buy.js "></script>
<script type="text/javascript " src="/mobile/js/layer.js "></script>
<script type="text/javascript">
    mui.init();
    $('#submit').click(function () {
        var oldPassword = $('input[name=oldPassword]').val();
        var password = $('input[name=password]').val();
        var password_confirmation = $('input[name=password_confirmation]').val();
        if (!oldPassword) {
            layer.open({
                content: '请输入原密码'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        if (!password) {
            layer.open({
                content: '请输入新密码'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        if (!password_confirmation || password != password_confirmation) {
            layer.open({
                content: '两次输入密码不相同'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        var FORM = {
            'oldPassword': oldPassword,
            'password': password,
            'password_confirmation': password_confirmation,
            '_token': '{{csrf_token()}}'
        };
        $.ajax({
            url: '/wap/user/changePassword',
            type: 'post',
            dataType: 'json',
            data: FORM,
            success: function (res) {
                layer.open({
                    content: res.message
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
                if(res.status){
                    location.href='/wap/user/accountSecurity';
                }
            }
        });
    });
</script>
</body>
</html>