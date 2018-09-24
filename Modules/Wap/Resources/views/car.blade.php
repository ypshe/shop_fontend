<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>购物车</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
<div id="app">
    <div class="head_com">
        <div class="hederbg">
            <a href="javascript:history.go(-1)" class="backIcon"></a>
            <h1>购物车</h1>
            <a href="javascript:;" @click="zhengli" class="sousuo">整理</a>
        </div>
    </div>
    <div class="topjiange"></div>
    <div class="buyList" style="display: none">
        <ul>
            <li v-for="(item,index) in list">
                <div class="mui-checkbox mui-left checkboxs">
                    <input class="good" @click="clickCheckbox($event)" :name="'good_'+index" :value="index" v-model="checkData" :id="'item'+index" type="checkbox">
                    <label :for="'item'+index"></label>
                </div>
                <div class="productList" >
                    <a href="javascript:void(0)">
                        <div class="productPic" @click="goDetail(item.id)"><img :src="item.pic" alt=""></div>
                        <div class="productText">
                            <div class="productName" @click="goDetail(item.id)">[[item.name]]</div>
                            <div class="productSc" @click="goDetail(item.id)">[[item.scNum]]人收藏</div>
                            <div class="productBottom">
                                <div class="productPrice">￥<span>[[item.price]]</span></div>
                                <div class="productNum">
                                    <span @click="sub(item)"/>-</span>
                                    <strong>[[item.number]]</strong>
                                    <span @click="add(item)"/>+</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class="footjinge"></div>
    <div class="buyCz">
        <div class="buyCzCon">
            <div class="mui-checkbox mui-left allChecks">
                <label for="all">
                    <input @click="checkAll($event)" id="all" type="checkbox">
                    全选
                </label>
            </div>
            <div class="buyCzCon-r">
                <div class="jiesuan" @click="submit()">结算</div>
                <div class="hejiPrice">合计：<span>￥ <span id="total" style="display: none;">[[total]]</span></span></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/layer.js "></script>
<script>
    var token = "{{csrf_token()}}";
</script>
<script type="text/javascript " src="/mobile/js/buy.js "></script>
<script type="text/javascript">
    mui.init();
</script>
</body>
</html>