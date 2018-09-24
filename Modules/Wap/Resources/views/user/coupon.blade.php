<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>优惠券</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="javascript:history.go(-1)" class="backIcon"></a>
                <h1>优惠券</h1>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="couponList">
            <ul>
                <li style="height: 6rem" v-for="(item,index) in list"  class="active" :class="{default:item.state==0}">
                    <div class="danxuan" v-if="item.state==1">
                        <input type="radio" name="adname" :id="'index'+index" :value="item.id" v-model="param">
                    </div>
                    <div class="couponCon" style="padding-top: 1.5rem">
                        <div class="couponCon-l">
                            <div class="price" :class="{shixiao:item.state==0}">￥<i>[[item.price]]</i><span>[ 满2000元可用 ]</span></div>
                            <div class="yxtime">有效期：[[item.startTime]]-[[item.endTime]]</div>
                        </div>
                        <div class="couponCon-r">
                            <span class="active" v-if="item.state==1" @click="gobuy">立即使用</span>
                            <span class="default" v-else-if="item.state==0">已失效</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="footjinge"></div>
        @include('wap::layouts.foot')
    </div>
    <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/coupon.js "></script>
</body>
</html>