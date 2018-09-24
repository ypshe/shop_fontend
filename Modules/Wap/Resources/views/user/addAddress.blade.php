<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>添加收货地址</title>
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/style.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.picker.css">
    <link rel="stylesheet" type="text/css" href="/mobile/css/mui.poppicker.css">
</head>

<body>
<div id="app">
    <div class="topjiange"></div>
    <div class="addDz">
        <div class="addDzRow">
            <div class="addDzRow-l">收 货 人</div>
            <div class="addDzRow-r">
                <input type="text" class="input-align" name="addressee" value="{{$address?$address->addressee:''}}"
                       placeholder="请输入收货人">
            </div>
        </div>
        <div class="addDzRow">
            <div class="addDzRow-l">手机号码</div>
            <div class="addDzRow-r">
                <input type="text" class="input-align" name="mobile" value="{{$address?$address->mobile:''}}"
                       placeholder="请输入手机号码">
            </div>
        </div>
        <div class="addDzRow">
            <div class="addDzRow-l">选择国家</div>
            <div class="addDzRow-r">
                <div class="selectCity" style="float: right">
                    <div class="selectCon" style="padding: 7px 0">
                        <span @if($address&&$address->country!='泰国')class="on" @endif id="chinas">中国</span>
                        <span @if($address&&$address->country=='泰国')class="on" @endif id="taoguos">泰国</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="selectBottom addDzRow" style="height: 44px;padding: 0 0;">
            <input style="height: 30px;font-size: 14px;@if($address&&$address->country=='泰国')display:none @endif" id='china'
                   value="@if($address&&$address->country=='中国'){{$address->province.' '.$address->city.' '.$address->town}}
                   @endif"
                   class="mui-btn mui-btn-block" type='text'
                   placeholder="选择城市">
            <input style="height: 30px;font-size: 14px;@if($address&&$address->country=='泰国')display:inline-block @endif"
                   type="text"
                   value="@if($address&&$address->country=='泰国') {{$address->address}}@endif" class="taiguo" id="taiguo"
                   name="address_taiguo"
                   placeholder="请手动输入泰国地址">
        </div>

        <div class="addDzRow" id="address" @if($address&&$address->country=='泰国')style="display: none;" @endif >
            <div class="addDzRow-l">详细地址</div>
            <div class="addDzRow-r">
                <input type="text" value="{{$address&&$address->country=='中国'?$address->address:''}}" name="address_china" value=""
                       placeholder="如道路/门牌号/小区/楼栋号等">
            </div>
        </div>
        <div class="head_com">
            <div class="hederbg">
                <a href="@if($isByOrder)/wap/user/selectAddress @else /wap/user/address @endif" class="backIcon"></a>
                <h1>选择地址</h1>
                <a href="javascript:;" id="submit" class="sousuo">保存</a>
            </div>
        </div>
    </div>
    <div class="addDz">
        <div class="addDzRow">
            <div class="addDzRow-l">设为默认</div>
            <div class="addDzRow-r">
                <div class="mui-switch @if(!$address||($address&&$address->is_default))mui-active @endif"
                     id="switch_id">
                    <div class="mui-switch-handle"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript " src="/mobile/js/mui.min.js "></script>
<script type="text/javascript " src="/mobile/js/jquery.min.js "></script>
<script type="text/javascript " src="/mobile/js/vue.js "></script>
<script type="text/javascript " src="/mobile/js/addrecevingAddress.js "></script>
<script type="text/javascript " src="/mobile/js/mui.picker.js "></script>
<script type="text/javascript " src="/mobile/js/mui.poppicker.js "></script>
<script type="text/javascript " src="/mobile/js/city.data-3.js "></script>
<script type="text/javascript " src="/mobile/js/layer.js "></script>
<script>
    mui.init({
        swipeBack: true //启用右滑关闭功能
    });
    mui('.mui-content .mui-switch').each(function () { //循环所有toggle
        //toggle.classList.contains('mui-active') 可识别该toggle的开关状态
        this.parentNode.querySelector('span').innerText = '状态：' + (this.classList.contains('mui-active') ? 'true' : 'false');
        /**
         * toggle 事件监听
         */
        this.addEventListener('toggle', function (event) {
            //event.detail.isActive 可直接获取当前状态
            this.parentNode.querySelector('span').innerText = '状态：' + (event.detail.isActive ? 'true' : 'false');
        });
    });
    $('#submit').click(function () {
        var mobile = $('input[name=mobile]').val();
        if (!mobile) {
            layer.open({
                content: '请输入收货人手机号码'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        var addressee = $('input[name=addressee]').val();
        if (!addressee) {
            layer.open({
                content: '请输入收货人'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        var FORM = {
            'mobile': mobile,
            'addressee': addressee
        };
        var switch_class = $('#switch_id').attr('class');
        if (switch_class.indexOf('active') != -1) {
            FORM.is_default = 1;
        } else {
            FORM.is_default = 0;
        }
        var country = $('span.on').attr('id');
        if (country === 'chinas') {
            FORM.country = '中国';
        } else {
            FORM.country = '泰国';
        }
        if (FORM.country === '中国') {
            var addr = $('#china').val();
            if (!addr) {
                layer.open({
                    content: '请选择城市'
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
                return false;
            } else {
                addr = addr.split(' ');
                FORM.province = addr[0];
                FORM.city = addr[1];
                FORM.town = addr[2];
            }
            address = $('input[name=address_china]').val();
            if (!address) {
                layer.open({
                    content: '请输入具体街道'
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
                return false;
            }
        } else {
            address = $('#taiguo').val();
            if (!address) {
                layer.open({
                    content: '请输入泰国地址'
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
                return false;
            }
        }
        FORM.address = address;
        FORM._token = "{{csrf_token()}}";
        FORM.isByOrder = "{{$isByOrder}}";
        @if($address)
            FORM.id = '{{$address->id}}';
        @endif
        $.ajax({
            url: '/wap/user/addAddressHandle',
            type: 'post',
            data: FORM,
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    layer.open({
                        content: res.message
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                    if(res.isByOrder){
                        location.href = '/wap/user/selectAddress';
                    }else{
                        location.href = '/wap/user/address';
                    }
                } else {
                    layer.open({
                        content: res.message
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                }
            }
        });

    });
    (function ($, doc) {
        $.init();
        $.ready(function () {
            //                  //级联示例
            var cityPicker3 = new $.PopPicker({
                layer: 3
            });
            cityPicker3.setData(cityData3);
            var china = doc.getElementById('china');
            china.addEventListener('tap', function (event) {
                cityPicker3.show(function (items) {
                    console.log(items[0].text + " " + items[1].text + " " + items[2].text)
                    doc.getElementById('china').value = items[0].text + " " + items[1].text + " " + items[2].text;
                    //返回 false 可以阻止选择框的关闭
                    //return false;
                });
            }, false);
        });
    })(mui, document);
    $(".selectCon span").click(function () {
        $(this).addClass('on').siblings().removeClass('on');
    });
    $('#chinas').click(function () {
        $('#address').show();
        $("#china").show();
        $("#taiguo").hide();
    });
    $('#taoguos').click(function () {
        $('#address').hide();
        $("#china").hide();
        $("#taiguo").show();
    });
</script>

</body>
</html>