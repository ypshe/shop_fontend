var app = new Vue({
	el:'#app',
	data:{
	},
	methods:{
		exit(){
            mui.toast('退出成功');
            window.location.href='/logout'
        }
	}
})