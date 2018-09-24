var app = new Vue({
    el: '#app',
    data: {
        loginfrom: {
            tel: '',
            pass: ''
        }
    },
    methods: {
        login() {
            var mobile = this.loginfrom.tel;
            var password = app.loginfrom.pass;
            if (!this.loginfrom.tel) {
                mui.toast('请输入手机号');
                return false;
            } else {
                var reg = /^1[34578]\d{9}$/;
                if (reg.test(this.loginfrom.tel)) {
                    // mui.toast('手机号格式正确');
                } else {
                    mui.toast('手机号格式不正确');
                    return false;
                }
            }
            if (!app.loginfrom.pass) {
                mui.toast('密码不能为空');
                return false;
            }
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: '/wap/loginHandle',
                type: 'post',
                data: {"mobile": mobile, "password": password},
                dataType: 'json',
                success: function (res) {
                    if (res.status === true) {
                        mui.toast('登录成功');
                        location.href=res.url;
                    } else {
                        mui.toast(res.message);
                    }
                }
            });
        }
    }
})