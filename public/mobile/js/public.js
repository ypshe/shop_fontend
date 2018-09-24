function checkAttr() {
    var status = $('#status');
    var attr = $('.zhonglei');
    $.each(attr, function () {
        var span = $(this).children('span');
        $(this).attr('status', 0);
        $.each(span, function () {
            var span_class = $(this).attr('class');
            var span_class_arr = span_class.split(' ');
            if (span_class_arr.indexOf('on') !== -1) {
                $(this).parent().attr('status', 1);
            }
        });
        if ($(this).attr('status') == 0) {
            layer.open({
                content: '请选择' + $(this).attr('data_name')
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            status.attr('status', 0);
            status.attr('error_name', $(this).attr('data_name'));
            status.attr('message', '请选择' + $(this).attr('data_name'));
        }
    });
    if (status.attr('status') == 0) {
        layer.open({
            content: status.attr('message')
            , skin: 'msg'
            , time: 2 //2秒后自动关闭
        });
        $('.gwc').attr('disabled', true);
        $('.ljgm').attr('disabled', true);
        return false;
    } else {
        $('.gwc').attr('disabled', false);
        $('.ljgm').attr('disabled', false);
    }
    return true;
}

function getAttrData() {
    var attr_data = {};
    var attr = $('.zhonglei');
    $.each(attr, function () {
        var span = $(this).children('span');
        $.each(span, function () {
            var span_class = $(this).attr('class');
            var span_class_arr = span_class.split(' ');
            if (span_class_arr.indexOf('on') !== -1) {
                attr_data[$(this).attr('data_id')] = $(this).text();
            }
        });
    });
    return attr_data;
}


function addBuyCar(id, token) {
    if (!checkAttr()) {
        return false;
    }
    var data = {};
    data['attr'] = getAttrData();
    data['_token'] = token;
    data['agent_goods_id'] = id;
    data['num'] = $('#num').val();
    data['price_sum'] = $('#price_sum').text();
    $.ajax({
        url: '/api/addBuyCar',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.status === true) {
                layer.open({
                    content: res.message
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
            } else {
                layer.open({
                    content: res.message
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
            }
        }
    });
}

function goToBuy(id, token) {
    if (!checkAttr()) {
        return false;
    }
    $.ajax({
        url: '/api/goToBuy',
        type: 'post',
        data: {
            '_token': token,
            'agent_goods_id': id
        },
        success: function (res) {
            if (res.status === true) {
                location.hef = res.url;
            } else {
                layer.msg(res.message);
            }
        }
    });
}