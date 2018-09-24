<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>个人资料</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
<div id="app">
    <div class="head_com">
        <div class="hederbg">
            <a href="javascript:history.go(-1)" class="backIcon"></a>
            <h1>个人资料</h1>
            <a href="javascript:;" id="submit" class="sousuo">保存</a>
        </div>
    </div>
    <div class="topjiange"></div>
    <form action="{{url('/wap/user/editHandle')}}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <div class="personal">
            <ul>
                <li>
                    <div class="personal-label">头像</div>
                    <div class="personal-value">
                        <img src="{{font_path($user->wx_pic?:$user->face?:'default.png')}}" alt="">
                        <input required type="file" class="files" name="face" value="" placeholder="">
                    </div>
                </li>
                <li>
                    <div class="personal-label">昵称</div>
                    <div class="personal-value">
                        <input required type="text" name="name" placeholder="请填写昵称"
                               value="{{Input::old('name',$user->name?:'')}}">
                    </div>
                </li>
                <li>
                    <div class="personal-label">联系电话</div>
                    <div class="personal-value">
                        <input required type="text" name="phone" placeholder="请填写联系电话"
                               value="{{Input::old('phone',$user->phone?:'')}}">
                    </div>
                </li>
                <li>
                    <div class="personal-label">性别</div>
                    <div class="personal-value">
                        <select required name="sex">
                            <option value="男" @if(Input::old('sex',$user->sex)=='男')selected @endif>男</option>
                            <option value="女" @if(Input::old('sex',$user->sex)=='女')selected @endif>女</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="personal-label">邮箱</div>
                    <div class="personal-value">
                        <input type="email" required name="email" placeholder="请填写邮箱"
                               value="{{Input::old('email',$user->email?:"")}}">
                    </div>
                </li>
            </ul>
        </div>
    </form>
</div>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/layer.js "></script>
<script type="text/javascript">
    @if (count($errors) > 0)
    layer.open({
        content: '{{$errors->first()}}'
        , skin: 'msg'
        , time: 2 //2秒后自动关闭
    });
    @endif
    mui.init();
    $('#submit').click(function () {
        var face = $('input[name=face]').val();
        var name = $('input[name=name]').val();
        var phone = $('input[name=phone]').val();
        var email = $('input[name=email]').val();
        if (!face) {
            layer.open({
                content: '请上传头像'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        if (!name) {
            layer.open({
                content: '昵称不能为空'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        if (!phone) {
            layer.open({
                content: '联系方式不能为空'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        if (!email) {
            layer.open({
                content: '邮箱不能为空'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        $('form').submit();
    });
</script>
</body>
</html>