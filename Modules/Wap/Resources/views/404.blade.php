<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>跳转中</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
    <style>
        .errorBox p a{
            width: 100px;
            display: inline-block;
            border: 0 solid #a0a0a0;
            color: #007aff;
            height: auto;
            line-height: normal;
            border-radius: inherit;
            font-size: inherit;
            margin: 0;
        }
    </style>
</head>

<body class="searchbg">
<div id="app">
    <div class="head_com">
        <div class="hederbg">
            <a href="javascript:history.go(-1)" class="backIcon"></a>
            <h1>跳转中</h1>
        </div>
    </div>
    <div class="topjiange"></div>
    <div class="errorBox">
        <img src="/mobile/images/404.png" alt="">
        <p>{!!$message!!}</p>
        @if($url)
            <p><span id="time">3</span>秒后自动跳转...</p>
            <a href="{{url('/logout')}}">退出</a>
            <a href="{{$url}}">点击跳转</a>
        @endif
    </div>
</div>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
</body>
<script>
    var i = 3;
    @if($url)
    $(function () {
        var t = setInterval("showAuto()", 1000);
    });
    @endif

    function showAuto() {
        i--;
        $("#time").html(i);
        if (i === 0) {
            location.href = "{{$url}}";
            clearTimeout(t);
        }
    }
</script>
</html>