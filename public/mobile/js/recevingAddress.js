var vueData = [];
var default_id = 0;

function getAddress() {
    $.ajaxSetup({async: false});
    $.ajax({
        url: '/api/getUserAddress',
        type: 'post',
        data: {_token: token},
        dataType: 'json',
        success: function (res) {
            vueData = res.list;
            default_id = res.default_id;
        }
    });
}

getAddress();
var app = new Vue({
    delimiters: ['[[', ']]'],
    el: '#app',
    data: {
        list: vueData,
        selected: default_id
    },
    methods: {
        selectAdd(id) {
            app.selected = id;

        },
        edit(id) {
            window.location.href = "/wap/user/addAddress/" + id
        }
    }
})
$('.addressList').show();