<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>列表</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="javascript:history.go(-1)" class="backIcon"></a>
                <div class="indexSearch">
                    <i class="searchIcon"></i>
                    <input type="text" name="" id="keywords" value="" @keyup.enter="search" placeholder="搜索关键词">
                </div>
                <a href="javascript:;" @click="search" class="sousuo">搜索</a>
            </div>
        </div>
        <div class="type">
        	<div class="typeCon typeCons">
	        	<span v-for="(item,index) in menu" :class="{on:index==slectIndex}" @click="menuItem(index)">[[item.name]]</span>
        	</div>
        </div>
        <div class="topjiange"></div>
        <div class="topjiange"></div>
        <div class="loveList list">
            <ul>
                <li v-for="item in list">
                    <a href="produceDetails.html">
	    				<img :src="item.imgurl" alt="">
	    				<div class="loveListText">
	    					<div class="loveName">[[item.name]]</div>
	    					<div class="loveMs">
	    						<div class="lovePrice">￥[[item.price]]</div>
	    						<div class="loveNum">已售出[[item.num]]件</div>
	    					</div>
	    				</div>
	    			</a>
                </li>
            </ul>
        </div>
        @include('wap::layouts.foot')
    </div>
	 <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/list.js "></script>
</body>
</html>