<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>账户与安全</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="/wap/user/set" class="backIcon"></a>
                <h1>账户与安全</h1>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="settingBox">
            <div class="setting">
                <ul>
                    <li>
                        <a href="{{url('/wap/user/changePhone')}}">
                            <div class="setting-item">修改手机号</div>
                            <div class="setting-right" style="top: 14px;"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('wap/user/changePassword')}}">
                            <div class="setting-item">修改登录密码</div>
                            <div class="setting-right"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
</body>
</html>