<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
<div id="app">
    <div class="header">
        <div class="indexTop">
            <div class="indexTopCon">
                <a href="{{url('/wap/category')}}" class="menuIcon"></a>
                <div class="indexSearch">
                    <i class="searchIcon"></i>
                    <input type="text" name="" value="" readonly @click="search" placeholder="搜索关键词">
                </div>
                <a href="{{url('/wap/message')}}" class="msgIcon"></a>
            </div>
        </div>
        <div id="slider" class="mui-slider">
            <div class="mui-slider-group mui-slider-loop">
                @foreach($ad as $value)
                    <div class="mui-slider-item mui-slider-item-duplicate">
                        <a href="#"><img src="{{agents_path($value->pic_url)}}"></a>
                    </div>
            @endforeach
            <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="#"><img src="{{agents_path($ad[0]->pic_url)}}"></a>
                </div>
            </div>
        </div>
    </div>
    @if(isset($cate)&&is_array($cate))
        <div class="first_menu">
            <ul>
                @if(in_array('吃',$cate))
                    <li style="width:{{$cate_width}}%">
                        <a href="{{url('/wap/category/'.array_search('吃',$cate))}}">
                            <img src="/mobile/images/chiIcon.jpg" alt="">
                            <p>吃</p>
                        </a>
                    </li>
                @endif
                @if(in_array('穿',$cate))
                    <li style="width:{{$cate_width}}%">
                        <a href="{{url('/wap/category/'.array_search('穿',$cate))}}">
                            <img src="/mobile/images/chuanIcon.jpg" alt="">
                            <p>穿</p>
                        </a>
                    </li>
                @endif
                @if(in_array('住',$cate))
                    <li style="width:{{$cate_width}}%">
                        <a href="{{url('/wap/category/'.array_search('住',$cate))}}">
                            <img src="/mobile/images/zhuIcon.jpg" alt="">
                            <p>住</p>
                        </a>
                    </li>
                @endif
                @if(in_array('用',$cate))
                    <li style="width:{{$cate_width}}%">
                        <a href="{{url('/wap/category/'.array_search('用',$cate))}}">
                            <img src="/mobile/images/yongIcon.jpg" alt="">
                            <p>用</p>
                        </a>
                    </li>
                @endif
                @if(in_array('行',$cate))
                    <li style="width:{{$cate_width}}%">
                        <a href="{{url('/wap/category/'.array_search('行',$cate))}}">
                            <img src="/mobile/images/xingIcon.png" alt="">
                            <p>行</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    @endif
    @if(isset($sale_good)&&!empty($sale_good))
        <div class="lanmuTitle"><span>特价</span>商品</div>
        <div class="tejiaList">
            <div id="tejiaList" class="mui-slider">
                <div class="mui-slider-group">
                    <div class="mui-slider-item mui-slider-item-duplicate">
                        @foreach(array_slice($sale_good,0,3) as $good)
                            <div class="tejia-item">
                                <a href="{{url('/wap/goodDetail/'.$good['agent_goods_id'])}}">
                                    <img width="97.48" height="77" src="{{agents_path($good['wap_image'])}}">
                                    <div class="productText">
                                        <div class="productTitle"
                                             style="height: 50px">{{mb_substr($good['name'],0,12)}}</div>
                                        <div class="productPrice">￥{{$good['market_price']}}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if(count($sale_good)>3)
                        <div class="mui-slider-item">
                            @foreach(array_slice($sale_good,3) as $good)
                                <div class="tejia-item">
                                    <a href="{{url('/wap/goodDetail/'.$good['agent_goods_id'])}}">
                                        <img width="97.48" height="77" src="{{agents_path($good['wap_image'])}}">
                                        <div class="productText">
                                            <div class="productTitle"
                                                 style="height: 50px">{{mb_substr($good['name'],0,12)}}</div>
                                            <div class="productPrice">￥{{$good['market_price']}}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="lanmuTitle"><span>猜你</span>喜欢<i>为你推荐精选好货</i></div>
    <div class="loveList" style="padding-bottom: 20px">
        <ul>
            <li v-for="item in loveList">
                <a :href="item.href">
                    <img width="162" height="128" :src="item.imgurl" alt="">
                    <div class="loveListText">
                        <div class="loveName">@{{item.name}}</div>
                        <div class="loveMs">
                            <div class="lovePrice">￥@{{item.price}}</div>
                            <div class="loveNum">已售出@{{item.num}}件</div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    @include('wap::layouts.foot')
</div>
<span id="data" style="display: none"></span>
<script type="text/javascript" src="/mobile/js/mui.min.js"></script>
<script type="text/javascript" src="/mobile/js/jquery.min.js"></script>
<script type="text/javascript" src="/mobile/js/vue.js"></script>
<script type="text/javascript" src="/mobile/js/index.js"></script>
</body>

</html>