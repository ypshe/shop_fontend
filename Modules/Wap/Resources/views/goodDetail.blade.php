<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>商品详情</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/lib/swiper/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
<div id="app">
    <div class="poductTop">
        <div class="poductTopCon">
            <div class="backIconBox">
                <a href="javascript:history.go(-1)"><span class="backIcon"></span></a>
            </div>
            <div class="poductTitle">商品详情</div>
            <div class="shareIconBox">
                <span class="shareIcon"></span>
            </div>
        </div>
    </div>
    <div class="poductPic">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($good['picture'] as $pic)
                    <div class="swiper-slide"><a href=""><img src="{{agents_path($pic->image_url)}}" alt=""></a></div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
        </div>
    </div>
    <div class="poductmsg">
        <div class="poductName">{{$good['name']}}</div>
        <div class="poductMs">
            <div class="poductPrice">￥{{$good['attr_price']}}<span>￥{{$good['market_price']}}</span></div>
            <div class="poductym">已售出{{$good['sales_num']}}件</div>
        </div>
    </div>
    <div class="poductRow">
        <div class="poductRow-l">已 选<span><span class="num">1</span> 件</span></div>
        <div class="poductRow-r"><span class="numSel" @click="selectGuige"></span></div>
    </div>
    <div class="poductRow">
        <div class="poductRow-l">运 费<span>包邮</span></div>
        <div class="poductRow-r"></div>
    </div>
    <!--评论-->
    @if($agent->goods_comment_switch)
        <div class="poductPl">
            <div class="poductPlTitle">
                <div class="poductPlTitle-l">评价(85 万+)</div>
                <div class="poductPlTitle-r">
                    <span>好评 98% </span>
                    <i class="rightIcon"></i>
                </div>
            </div>
            <div class="poductPlCon">
                <ul>
                    <li>
                        <div class="Pl-title">
                            <div class="Pl-title-l"><span class="onexing"></span></div>
                            <div class="Pl-title-r">李**新</div>
                        </div>
                        <div class="Pl-text">
                            也是第一次网上买鸡蛋。今天下午刚收到鸡蛋，两箱中有一箱破了三个，另一张箱还好。蛋看着还是比较新鲜，没有尝也不知道是不是资格土鸡蛋。等后面吃了再追评。破损的，卖家要给补上是吗？
                        </div>
                        <div class="Pl-pic">
                            <ul>
                                <li><img src="/mobile/images/pic/pic1.png" alt=""></li>
                                <li><img src="/mobile/images/pic/pic1.png" alt=""></li>
                                <li><img src="/mobile/images/pic/pic1.png" alt=""></li>
                                <li><img src="/mobile/images/pic/pic1.png" alt=""></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="chakanMore"
                     onclick="javascript:location.href='{{url('/wap/comment/'.$good['agent_goods_id'])}}'">
                    <span>查看更多评价</span>
                </div>
            </div>
        </div>
    @endif
    <div class="produceOther">
        <div class="produceOthers">
            <span class="on" @click="items(1)">图文详情</span>
            <span @click="items(2)">商品参数</span>
            <span @click="items(3)">售后服务</span>
        </div>
        <!-- 图文详情 -->
        <div class="produceConts" v-show="Istuwen">
            {!! $good['goods_content'] !!}
        </div>
        <!-- 商品参数 -->
        <div class="produceConts" v-show="Iscanshu">
            <table>
                <tbody>
                <tr>
                    <td>品牌</td>
                    <td>{{$good['brand']?$good['brand']['brand_name']:''}}</td>
                </tr>
                <tr>
                    <td>类别</td>
                    <td>{{$good['cate']?$good['cate']['name']:''}}</td>
                </tr>
                <tr>
                    <td>重量（或净含量）</td>
                    <td>{{$good['weight']}}</td>
                </tr>
                @if($good['how_use'])
                    <tr>
                        <td>使用方法</td>
                        <td>{{$good['how_use']}}</td>
                    </tr>
                @endif
                @if($good['best_date'])
                    <tr>
                        <td>保质期</td>
                        <td>{{$good['best_date']}}天</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <!-- 售后服务 -->
        <div class="produceConts" v-show="Isshouhou">
            {!! $agent->back_service !!}
        </div>
    </div>
@if(!$commandGood->isEmpty())
    <!-- 相关推荐 -->
        <div class="tuijian">
            <div class="tuijianTitle">相关推荐</div>
            <div class="tuijianList">
                <ul>
                    @foreach($commandGood as $item)
                        <li>
                            <a href="{{url('/wap/goodDetail/'.$item->agent_goods_id)}}">
                                <div class="tuijianPic">
                                    <img width="100" height="100" src="{{agents_path($item->wap_image)}}" alt="">
                                </div>
                                <div class="tuijianText" style="height: 50px">{{mb_substr($item->name,0,12)}}</div>
                                <div class="tuijianPrice">￥{{$item->market_price}}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
@endif
<!-- foot按钮 -->
    <div class="probutonjg"></div>
    <div class="probuton">
        <div class="probutonCon">
            <div class="probuton-l">
                <ul>
                    <li>
                        <div class="probutonIcon kefuIcon"></div>
                        <p>客服</p>
                    </li>
                    <li onclick="collectGood()">
                        <div class="probutonIcon shoucangIcon"></div>
                        <p>收藏</p>
                    </li>
                </ul>
            </div>
            <div class="probuton-r">
                <span class="gouwuc" @click="selectGuige">加入购物车</span>
                <span class="goumai" @click="selectGuige">立即购买</span>
            </div>
        </div>
    </div>
    <!-- 规格弹出层 -->
    <div class="zhezhaobg" v-show="Iszhezhao"></div>
    <div class="guige" v-show="Isguige">
        <div class="guigeCon">
            <div class="guigeCons">
                <i class="closeIcon" @click="close"></i>
                <div class="thuimb"><img src="{{agents_path($good['wap_image'])}}" alt=""></div>
                <div class="guigeText">
                    <div class="guigeName" style="height: 50px">
                        {{$good['name']}}
                    </div>
                    <div class="guigePrice" id="price">￥<span id="price_sum"></span></div>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="guigeBtm">
                <div class="row">
                    <div class="guigeBtm-l">已选</div>
                    <div class="guigeBtm-r yixuan">
                        @if(!empty($attr['attr']))
                            <span id="attr_value">@foreach($attr['attr'] as $id=>$value)@if(is_array($value['value'])){{$value['value'][0]}} @endif @endforeach</span>
                        @endif
                        <span><span id="checkNum">1</span>件</span>
                    </div>
                </div>
                @if(!empty($attr['attr']))
                    @foreach($attr['attr'] as $value)
                        <div class="row">
                            <div class="guigeBtm-l">{{$value['name']}}</div>
                            <div class="guigeBtm-r zhonglei" status="" data_name="{{$value['name']}}">
                                @if($value['type']==1 && is_array($value['value']))
                                    <?php $i = 0;?>
                                    @foreach($value['value'] as $attr_value)
                                        <span data_id="{{$value['id']}}"
                                              class="@if($i==0)on @endif clickChange">{{$attr_value}}</span>
                                        <?php $i++;?>
                                    @endforeach
                                @else
                                    <span class="on" data_id="{{$value['id']}}"
                                          style="border: none">{{$value['value']}}</span>
                                @endif
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="guigeBtm-l">数量</div>
                    <div class="guigeBtm-r">
                        <div class="mui-numbox">
                            <button disabled class="mui-btn mui-btn-numbox-minus" id="minus" type="button">-</button>
                            <input id="num" class="mui-input-numbox" value="1" type="number"/>
                            <button class="mui-btn mui-btn-numbox-plus" id="plus" type="button">+</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="guigefot">
                <span class="gwc" onclick="addBuyCar('{{$good['agent_goods_id']}}','{{csrf_token()}}')">加入购物车</span>
                <span class="ljgm" onclick="goToBuy('{{$good['agent_goods_id']}}','{{csrf_token()}}')">立即购买</span>
            </div>
        </div>
    </div>
</div>
<span id="status" disabled style="display: none;" status=1 error_name=""></span>
<span id="attr_data" disabled style="display: none;" value="1"></span>
<script>
    var price = JSON.parse('{!! $attr['price'] !!}');
</script>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/lib/swiper/js/swiper.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/prodectDetalis.js "></script>
<script type="text/javascript " src="/mobile/js/public.js "></script>
<script type="text/javascript " src="/mobile/js/layer.js "></script>

<script>
    getPrice();
    function collectGood() {
        var agent_goods_id = '{{$good['agent_goods_id']}}';
        $.ajax({
            url: '/api/collectGood',
            data: {
                '_token': '{{ csrf_token() }}',
                'agent_goods_id': agent_goods_id
            },
            type: 'post',
            dataType: 'json',
            success: function (res) {
                layer.open({
                    content: res.message
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
            }
        });
    }
</script>
</body>
</html>