<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>分类</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="javascript:history.go(-1)" class="backIcon"></a>
                <h1>分类</h1>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="categoryBox" style="display: none">
            <ul>
                <li v-for=" item in list">
                    <a :href="'/wap/category/'+item.id">
	 					<img :src="item.img" alt="">
	 					<p>[[item.name]]</p>
	 				</a>
                </li>
            </ul>
        </div>
        @include('wap::layouts.foot')
    </div>
    <script>
        var token="{{csrf_token()}}";
    </script>
	 <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/category.js "></script>
</body>
</html>