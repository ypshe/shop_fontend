var app = new Vue({
	el:'#app',
	data:{
		list:[
			{
				state:1,
				price:5,
				manzu:298,
				start:'2018.4.01',
				end:'2018.08.31'
			},
			{
				state:1,
				price:5,
				manzu:298,
				start:'2018.4.01',
				end:'2018.08.31'
			},
			{
				state:0,
				price:5,
				manzu:298,
				start:'2018.4.01',
				end:'2018.08.31'
			}
		],
		isBg:false,
		isyh:false,
	},
	methods:{
		tijiao(){
            mui.toast('提交成功');
        },
        selecthyq(){
        	app.isBg = true;
        	app.isyh = true;
        },
        shiyong(){
        	app.isBg = true;
        	app.isyh = true;
        },
        zhezheClose(){
        	app.isBg = false;
        	app.isyh = false;
        },
        qdsy(){
        	app.isBg = false;
        	app.isyh = false;
        }
	}
})