<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>搜索</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body class="searchbg">
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="/wap" class="backIcon"></a>
                <div class="indexSearch">
                    <i class="searchIcon"></i>
                    <input type="text" name="" id="keywords" value="" @keyup.enter="search" placeholder="输入你要搜索的商品名称">
                </div>
                <a href="javascript:;" @click="search" class="sousuo">搜索</a>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="searchBox">
            <div class="searchHistory">
                <div class="searchTitle">历史搜索<i class="clearIcon"></i></div>
                <div class="searchCon"> 
                    <span>樱桃面膜</span>
                    <span>泰国彩虹皂</span>
                    <span>手机</span>
                    <span>防晒喷雾</span>
                    <span>洗面奶</span>
                    <span>水果</span>
                </div>
            </div>  
            <div class="searchHot">
                <div class="searchTitle">热门搜索</div>
                <div class="searchCon"> 
                    <span>樱桃面膜</span>
                    <span>泰国彩虹皂</span>
                    <span>手机</span>
                    <span>防晒喷雾</span>
                    <span>洗面奶</span>
                    <span>水果</span>
                </div>
            </div> 
        </div>
        @include('wap::layouts.foot')
	 </div>
	 <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
</body>
</html>