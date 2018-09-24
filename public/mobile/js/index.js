var vueData = [];
var page = 1;

function getData() {
    $.ajaxSetup({async: false});
    $.ajax({
        url: '/wap/getGood?page=' + page,
        type: 'get',
        dataType: 'json',
        success: function (res) {
            vueData = res;
            page++;
        }
    });
}

getData();
var len=vueData.length;
var app = new Vue({
    el: '#app',
    data: {
        loveList: vueData
    },
    methods: {
        search() {
            window.location.href = "/wap/search";
        }
    }
});
mui.init();
var slider = mui("#slider");
slider.slider({
    interval: 3000
});
var status = 1;
//滚动条滑动到底部事件
$(window).scroll(function () {
    var scrollTop = $(this).scrollTop();
    var scrollHeight = $(document).height();
    var windowHeight = $(this).height();
    if (scrollTop + windowHeight + 20 > scrollHeight && vueData.length===len) {
        getData();
        console.log(vueData);
        var obj = {};
        for (var x in vueData){
            app.loveList.push(vueData[x]);
        }
    }
});


