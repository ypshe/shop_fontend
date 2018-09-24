var vueData = [];

function getCart() {
    $.ajaxSetup({async: false});
    $.ajax({
        url: '/api/getCart',
        type: 'post',
        data: {_token: token},
        dataType: 'json',
        success: function (res) {
            vueData = res.list;
        }
    });
}

getCart();

var app = new Vue({
    delimiters: ['[[', ']]'],
    el: '#app',
    data: {
        list: vueData,
        total: 0, //总价
        checkData: [] // 双向数据绑定的数组
    },
    watch: {
        checkData: { // 监视双向绑定的数组变化
            handler(){
                if(this.checkData.length == this.list.length){
                    document.querySelector('#all').checked = true;
                }else {
                    document.querySelector('#all').checked = false;
                }
            },
            deep: true
        }
    },
    methods:{
        zhengli(){},
        //相减
        sub:function (item) {
            item.number--;
            if(item.number <= 1){
                item.number = 1
            }
            this.count(0)
        },
        //相加
        add:function (item) {
            item.number++;
            this.count(0)
        },
        count:function (status) {
            var totalPrice = 0;//临时总价
            if(status===2){
                this.total = parseFloat(totalPrice);
                return false;
            }
            this.list.forEach(function (val, index) {
                if (document.querySelector('#item' + index).checked || status) {
                    totalPrice += val.number * val.price;//累计总价
                }
            });
            this.total = parseFloat(totalPrice);
        },
        checkAll:function(e){ // 点击全选事件
            if(e.target.checked){
                this.list.forEach((el,i)=>{
                    // 数组里没有这一个value才push，防止重复push
                    if(this.checkData.indexOf(el.id) == '-1'){
                    this.checkData.push(el.id);
                }
                this.count(1)
            });
            }else { // 全不选选则清空绑定的数组
                this.checkData = [];
                this.count(2)
            }
        },
        clickCheckbox:function () {
            this.count(0)
        },
        goDetail:function(id){
            location.href='/wap/goodDetail/'+id;
        },
        submit:function () {
            if(this.checkData.length===0){
                layer.open({
                    content: '请选择需要结算的商品'
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
                return false;
            }
            var data={};
            data.data=[];
            var obj=this;
            this.checkData.forEach(function (val, index) {
                data.data.push(obj.list[val])
            });
            ajaxSubmit(data);
        }
    },
    created: function() {
        // this.count();
    }
});
$('.buyList').show();
$('#total').show();
function ajaxSubmit(data){
    data._token=token;
    $.ajax({
        url:'/api/checkout',
        type:'post',
        data:data,
        dataType:'json',
        success:function(res){
            if(res.status){
                location.href='/wap/orderConfirm?car_id='+res.car_id;
            }else{
                layer.open({
                    content: res.message
                    , skin: 'msg'
                    , time: 2 //2秒后自动关闭
                });
                return false;
            }
        }
    });
}