<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>我的收藏</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>
<body class="myCollectionbg">
<div id="app">
    <div class="head_com">
        <div class="hederbg">
            <a href="/wap/user" class="backIcon"></a>
            <h1>我的收藏</h1>
        </div>
    </div>
    <div class="topjiange"></div>
    <div class="myCollection" style="display: none;">
        <ul>
            <li v-for="(item,index) in list">
                <div class="proPic"><a :href="item.url"><img :src="item.imgurl"> </a></div>
                <div class="protext">
                    <div class="protitle"><a :href="item.url">[[ item.name ]]</a></div>
                    <div class="prosc">[[ item.num ]]人收藏</div>
                    <div class="proms">
                        <div class="proPrice">￥[[ item.price ]]</div>
                        <div class="prodel" @click="del(item.id,index)">删除</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    @include('wap::layouts.foot')
</div>
<script>
    var token = '{{csrf_token()}}';
</script>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/myCollection.js "></script>
<script type="text/javascript " src="/mobile/js/layer.js "></script>

</body>
</html>