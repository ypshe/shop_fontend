<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>确认订单</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
</head>

<body>
    <div id="app">
        <div class="head_com">
            <div class="hederbg">
                <a href="{{$back_url}}" class="backIcon"></a>
                <h1>确认订单</h1>
            </div>
        </div>
        <div class="topjiange"></div>
        <div class="orderDetails">
            <div class="addressMsg">
                <a href="/wap/user/selectAddress">
                    @if($address)
                    <div class="userMsg"><i class="zbIcon"></i>{{$address['addressee']}}<span>{{$address['mobile']}}</span></div>
                    <div class="useradd">
                        @if($address['country']=='泰国')
                            {{$address['country']}}
                        @else
                            {{$address['province']}}
                            {{$address['city']}}
                            {{$address['town']}}
                        @endif
                        {{$address['address']}}
                        <i class="rightIcon"></i></div>
                    @else
                        <div class="userMsg"><i class="zbIcon"></i>请选择地址<span></span></div>
                    @endif
                </a>
            </div>
            <div class="orderDetailCon">
                @foreach($good['good'] as $item)
                <div class="productMsg">
                    <a href="/wap/goodDetail/{{$item['good_id']}}">
                        <div class="productPic"><img src="{{$item['pic']}}" alt=""></div>
                        <div class="producttext">
                            <div class="productTitle">{{$item['name']}}</div>
                            <div class="productMs">
                                <div class="productPrice qrddPrice">￥{{$item['single_price']}}</div>
                                <div class="productNums">×{{$item['num']}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="productMenu" style="padding-bottom: 5px;">
                    <div class="productRow" style="border: none">
                        <div class="productlabel">购买数量</div>
                        <div class="productvalue">
                            <div class="mui-numbox">
                                <button class="mui-btn mui-btn-numbox-minus" type="button">-</button>
                                <input class="mui-input-numbox" type="number" value="{{$item['num']}}"/>
                                <button class="mui-btn mui-btn-numbox-plus" type="button">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="productMenu">
                    <div class="productRow">
                        <div class="productlabel">配送方式</div>
                        <div class="productvalue">快递 包邮</div>
                    </div>
                </div>
                <div class="productMenu">
                    <div class="productRow">
                        <a href="javascript:;" @click="selecthyq">
                            <div class="productlabel">优惠券</div>
                            <div class="productvalue">-￥20,满99可用<i class="rightIcon"></i></div>
                        </a>
                    </div>
                </div>
                <div class="productMenu">
                    <div class="productRow">
                        <div class="productlabel">商品金额</div>
                        <div class="productvalue qrddPrices">￥{{$good['sum']}}</div>
                    </div>
                    <div class="productRow">
                        <div class="productlabel">运费</div>
                        <div class="productvalue qrddPrices">￥0.00</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="orderDetailBom">
            <div class="orderBottom-canzuo">
                <div class="ordermsg">
                    共 1 件，总金额：<i>￥{{$order['sum']}}</i>
                </div>
               <span class="tijiaoorder" @click="tijiao">提交订单</span>
            </div>
        </div>
	
     <!-- 弹窗 -->
     <div class="zhezhaobg" v-show="isBg" @click="zhezheClose"></div>
     <div class="youhuiqBox" v-show="isyh">
         <div class="youhuiqcon">
             <div class="youhuiq-title">优惠券</div>
             <div class="youhuiq-list">
                 <ul>
                     <li class="active" v-for="(item,index) in list" :class="{default:item.state==0}">
                         <div class="youhuiq-l">
                             <div class="youhuiqPri">￥<b>[[item.price]]</b></div>
                             <div class="youhuiqms">
                                 满[[item.manzu]]使用<br>有限期[[item.start]]-[[item.end]]
                             </div>
                         </div>
                         <div class="youhuiq-r" v-if="item.state==1" @click="shiyong">
                             <span class="topy"></span>
                             立即使用
                             <span class="btpy"></span>
                         </div>
                         <div class="youhuiq-r" v-else-if="item.state==0">
                             <span class="topy"></span>
                             不可使用
                             <span class="btpy"></span>
                         </div>
                     </li>
                 </ul>
             </div> 
             <div class="youhuiq-qd" @click="qdsy">确定</div>    
         </div>
     </div>
      </div>
	 <script type="text/javascript " src="/mobile/js/mui.min.js "></script>
    <script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
    <script type="text/javascript " src="/mobile/js/vue.js "></script>
    <script type="text/javascript " src="/mobile/js/orderquren.js "></script>
</body>
</html>