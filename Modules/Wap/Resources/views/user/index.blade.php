<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>
<body>
	<div id="app">
		<div class="center-top">
			<div class="head_com">
	            <div class="hederbg" style="background: none;">
	                <a href="javascript:history.go(-1)" class="backIcon"></a>
	                <a href="{{url('/wap/user/set')}}" class="sousuo">设置</a>
	            </div>
	        </div>
	        <div class="huiy-t">
	        	<div class="toux">
                    <img src="{{font_path($user->wx_pic?:$user->face?:'default.png')}}" alt="">
                </div>
	        	<div class="member-name">{{$user->name?:'昵称未设置'}}</div>
				<a href="{{url('/wap/user/edit')}}"><span class="editIcon"></span></a>
	        </div>
		</div>
		<div class="huiyMenu">
        	<ul>
        		<li>
        			<a href="allOrder.html">
        				<div class="huiyIcon daishenhe"></div>
        				<p>待审核</p>
        			</a>
        		</li>
        		<li>
        			<a href="allOrder.html">
        				<div class="huiyIcon daishouhuo"></div>
        				<p>待收货</p>
        			</a>
        		</li>
        		<li>
        			<a href="allOrder.html">
        				<div class="huiyIcon daipingjia"></div>
        				<p>待评价</p>
        			</a>
        		</li>
        		<li>
        			<a href="allOrder.html">
        				<div class="huiyIcon daidang"></div>
        				<p>全部订单</p>
        			</a>
        		</li>
        	</ul>
        </div>
        <div class="huiyListMenu">
        	<ul>
        		<li>
        			<a href="{{url('/wap/user/collection')}}">
        				<div class="huiyListIcon scIcon"></div>
        				<div class="huiyListText">我的收藏</div>
        				<div class="huiyListright"></div>
        			</a>
        		</li>
        		<li>
        			<a href="{{url('/wap/user/coupon')}}">
        				<div class="huiyListIcon yhIcon"></div>
        				<div class="huiyListText">我的优惠券</div>
        				<div class="huiyListright"></div>
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