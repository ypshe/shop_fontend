var countdown=60;
var status=0;
var app = new Vue({
    el: '#app',
    data: {
    	register:{
            phone:'',
            password:'',
            password_confirmation:'',
            captcha:'',
            sms:''
        }
    },
    methods: {
        getCode() {
            var obj = $("#btn");
            var thisObj=this;
            if(!this.register.phone){
                mui.toast('请先输入手机号');
                return false;
            }
            if(!this.register.captcha){
                mui.toast('请先输入验证码');
                return false;
            }
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:'/ajax/confirm/captcha',
                type:'post',
                dataType:'json',
                data:{'captcha':$('input[name=captcha]').val(),'phone':$('input[name=phone]').val()},
                success:function(res){
                    if(res.status==='success'){
                        status = 1;
                        mui.toast('短信发送成功，请注意查收！');
                        thisObj.settime(obj);
                    }else{
                        mui.toast(res.message);
                        $('#captcha').click();
                        return false;
                    }
                }
            });
        },
        settime(obj) {
            console.log(1);
            if (countdown == 0) {
                obj.attr('disabled', false);
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
        registersub(){
        	if(!this.register.phone){
        		mui.toast('请输入手机号');
        		return false;
        	}else{
        		var reg = /^1[34578]\d{9}$/;
        		if(reg.test(this.register.phone)){
        			// mui.toast('手机号格式正确');
        		}else{
        			mui.toast('手机号格式不正确');
        			return false;
        		}
        	}
            if(!this.register.password){
                mui.toast('请输入密码');
                return false;
            }
            if(!this.register.password_confirmation||this.register.password_confirmation!==this.register.password){
                mui.toast('两次输入密码不相同');
                return false;
            }
        	if(!this.register.captcha){
        		mui.toast('请输入验证码');
        		return false;
        	}
            if(this.register.sms && status || 1){
                $('#register').submit();
            }else{
                mui.toast('短信验证码有误！');
                return false;
            }
        }
    }
});