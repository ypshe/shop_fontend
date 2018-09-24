<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>修改手机号</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body class="searchbg">
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="javascript:history.go(-1)" class="backIcon"></a>
                <h1>修改手机号</h1>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="form-control">
            <div class="form-row changePhone">
                <div class="form-label">原手机号</div>
                <div class="form-input"><input type="text" name="" value="" placeholder="请输入原手机号" v-model="phone"></div>
                <input type="button" class="sendMsg" id="btn" value="发送验证码" @click="getCode">
            </div>
            <div class="form-row changePhone">
                <div class="form-label">验证码</div>
                <div class="form-input"><input type="text" name="" value="" placeholder="请输入手机短信中的验证码" v-model="code"></div>
            </div>
            <div class="form-ms"></div>
            <div class="form-btn">
                <span @click="update">修改</span>
            </div>
        </div>
        <div class="form-control" style="display: none;">
            <div class="form-succ"><img src="/mobile/images/succ.png" alt=""></div>
            <div class="form-msg">修改成功</div>
            <div class="form-btn">
                <span>确认</span>
            </div>
        </div>
    </div>
	<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/changePhone.js "></script>
    <script type="text/javascript">
        mui.init();
    </script>
</body>
</html>