<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>选择收货地址</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="/wap/orderConfirm?address=-1" class="backIcon"></a>
                <h1>收货地址</h1>
                <a href="{{url('wap/user/addAddressByOrder')}}" class="sousuo">添加</a>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="addressList" style="display: none">
            <ul>
                <li v-for="(item,index) in list">
                    <div class="address-l" @click="selectAdd(item.id)">
                        <div class="address-t">[[item.name]]<span>[[item.tel]]</span></div>
                        <div class="address-b">
                            <span class="default" v-if="item.id==selected">默认</span>
                            <div class="addressCon" :class="{addressCons:item.id==selected}">
                                [[item.address]]
                            </div>
                        </div>
                    </div>
                    <div class="address-edit" @click="edit(item.id)">选择</div>
                </li>
            </ul>
        </div>
	</div>
    <script>
        var token='{{csrf_token()}}';
    </script>
	<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/selectAddress.js "></script>
</body>
</html>