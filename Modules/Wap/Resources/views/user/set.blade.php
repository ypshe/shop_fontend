<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>设置</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="/wap/user" class="backIcon"></a>
                <h1>设置</h1>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="settingBox">
            <div class="setting">
                <ul>
                    <a href="{{url('/wap/user/edit')}}">
                    <li style="border-bottom: 1px solid #eeeeee">
                            <div class="setting-toux">
                                <img src="{{font_path($user->wx_pic?:$user->face?:'default.png')}}" alt="">
                            </div>
                            <div class="setting-text">
                                <b>{{$user->name?:"昵称未设置"}}</b>
                                <p>{{$user->mobile}}</p>
                            </div>
                            <div class="setting-right"></div>
                    </li>
                    </a>
                    <li>
                        <a href="{{url('/wap/user/address')}}">
                            <div class="setting-item">我的收获地址</div>
                            <div class="setting-right"></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="setting">
                <ul>
                    <li>
                        <a href="{{url('/wap/user/accountSecurity')}}">
                            <div class="setting-item">账户与安全</div>
                            <div class="setting-right"></div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <div class="setting-item">关于我们</div>
                            <div class="setting-right"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="setting-exit">
            <div class="setting-exitBtn" @click="exit">退出当前账户</div>
        </div>
    </div>
    <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/setting.js "></script>
</body>
</html>