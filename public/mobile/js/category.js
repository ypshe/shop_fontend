var vueData = [];

function getCate() {
    $.ajaxSetup({async: false});
    $.ajax({
        url: '/api/getTopCate',
        type: 'post',
        data: {_token: token},
        dataType: 'json',
        success: function (res) {
            vueData = res.list;
        }
    });
}

getCate();
var app = new Vue({
    delimiters: ['[[', ']]'],
    el: '#app',
    data: {
        list: vueData
    }
});
$('.categoryBox').show();

