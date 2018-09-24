var app = new Vue({
    el: '#app',
    data: {
        Istuwen: true,
        Iscanshu: false,
        Isshouhou: false,
        Iszhezhao: false,
        Isguige: false
    },
    methods: {
        items(id) {
            switch (id) {
                case 1:
                    app.Istuwen = true;
                    app.Iscanshu = false;
                    app.Isshouhou = false;
                    break;
                case 2:
                    app.Istuwen = false;
                    app.Iscanshu = true;
                    app.Isshouhou = false;
                    break;
                case 3:
                    app.Istuwen = false;
                    app.Iscanshu = false;
                    app.Isshouhou = true;
                    break;
            }
        },
        selectGuige() {
            app.Iszhezhao = true;
            app.Isguige = true;
        },
        close() {
            app.Iszhezhao = false;
            app.Isguige = false;
        }
    }
})
$('.produceOthers span').click(function () {
    $(this).addClass('on').siblings().removeClass('on');
});
$(window).bind("scroll", function () {
    var top = $(this).scrollTop(); // 当前窗口的滚动距离
    if (top >= 40) {
        $(".poductTopCon").addClass('poductTopbg');
    } else {
        $(".poductTopCon").removeClass('poductTopbg');
    }
});

var swiper = new Swiper('.poductPic .swiper-container', {
    pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
$('.clickChange').click(function () {
    $(this).addClass('on');
    var brother = $(this).siblings();
    $.each(brother, function () {
        $(this).removeClass('on');
    });
    var str = '';
    $.each($('.clickChange.on'), function () {
        var id = $(this).attr('data_id');
        str = str ? str + ' ' + $(this).text() : $(this).text();
        $('#attr_value').text(str)
    });
    getPrice()
});

function getPrice() {
    var status = $('#status');
    if ((price instanceof Array) == false) {
        var price_sum = $('#checkNum').text() * price;
        $('#price_sum').text(price_sum);
        return true;
    }
    if (price.length == 1) {
        var price_sum = $('#checkNum').text() * price[0].price;
        $('#price_sum').text(price_sum);
        return true;
    }
    status.attr('status', 0);
    var attr_value = $('#attr_value').text().replace(/^\s+|\s+$/g, "");
    if (attr_value.indexOf('  ') !== -1) {
        attr_value = attr_value.split('  ').join(' ');
    }
    $.each(price, function (index, value) {
        if (value.value.join(' ') === attr_value) {
            var price_sum = $('#checkNum').text() * value.price;
            $('#price_sum').text(price_sum);
            status.attr('status', 1);
            return false;
        }
    });
    if (status.attr('status') == 0) {
        layer.open({
            content: '该规格商品还未上架，请先选择其他规格'
            , skin: 'msg'
            , time: 2 //2秒后自动关闭
        });
        $('#price_sum').text('** ');
        status.attr('message', '该规格商品还未上架，请先选择其他规格');
        return false;
    }
}

$('.poductRow-r').click(getPrice);
$('#plus').click(checkNum);
$('#minus').click(checkNum);

function checkNum() {
    var value = parseInt($('#num').val());
    if (value <= 1) {
        if (value == 0) {
            $('#num').val(1);
        }
        $('#minus').attr('disabled', "true");
    } else {
        $('#minus').removeAttr('disabled')
    }
    $('#checkNum').text($('#num').val());
    $('.num').text($('#num').val());
    getPrice()
}
