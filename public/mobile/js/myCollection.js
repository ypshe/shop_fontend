var vueData = [];

function getCollection() {
    $.ajaxSetup({async: false});
    $.ajax({
        url: '/api/getCollection',
        type: 'post',
        data: {_token: token},
        dataType: 'json',
        success: function (res) {
            vueData = res.list;
        }
    });
}

getCollection();

var app = new Vue({
    delimiters: ['[[', ']]'],
    el: '#app',
    data: {
        list: vueData
    },
    methods: {
        del(id, index) {
            var list=this.list;
            $.ajaxSetup({async: false});
            $.ajax({
                url: '/api/delCollection',
                type: 'post',
                data: {_token: token, id: id},
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        list.splice(index, 1);
                    }
                    layer.open({
                        content: res.message
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                }
            });
        }
    }
})
$('.myCollection').show()