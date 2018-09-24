var countdown=60;
var app = new Vue({
    el: '#app',
    data: {
    	forget:{
            tel:'',
            pass:'',
            pass2:'',
            imgcode:'',
            code:''
        }
    },
    methods: {
        getCode() {
            var obj = $("#btn");
            this.settime(obj);
        },
        settime(obj) {
            if (countdown == 0) {
                obj.attr('disabled', false);
                //obj.removeattr("disabled"); 
                obj.val("发送验证码");
                countdown = 60;
                return;
            } else {
                obj.attr('disabled', true);
                obj.val("重新发送(" + countdown + ")");
                countdown--;
            }
            setTimeout(function() {
                app.settime(obj)
            }, 1000)
        },
        forgetbtn(){
        	if(!this.forget.tel){
        		mui.toast('请输入手机号');
        		return false;
        	}else{
        		var reg = /^1[34578]\d{9}$/;
        		if(reg.test(this.forget.tel)){
        			mui.toast('手机号格式正确');
        		}else{
        			mui.toast('手机号格式不正确');
        			return false;
        		}
        	}
        	if(!this.forget.code){
        		mui.toast('请输入验证码');
        		return false;
        	}
        	/*$.ajax({
        		url:'',
        		type:'',
        		data:{},
        		dataType:'json',
        		success:function(res){}
        	})*/
        }
    }
}) 