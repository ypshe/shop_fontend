var app = new Vue({
	el:'#app',
	data:{
		menu:[
			{
				id:0,
				name:'全部'
			},
			{
				id:1,
				name:'特价'
			},{
				id:2,
				name:'吃'
			},{
				id:3,
				name:'穿'
			},{
				id:4,
				name:'住'
			},{
				id:5,
				name:'用'
			},{
				id:6,
				name:'行'
			},
		],
		slectIndex:0,
		list:[
			{
				imgurl:'wap/images/pic/pic1.png',
				name:'泰国 Beauty Buffet Q10牛奶洗面奶 滋润深层洁面乳',
				price:'117.00',
				num:'3'
			},
			{
				imgurl:'wap/images/pic/pic1.png',
				name:'泰国 Beauty Buffet Q10牛奶洗面奶 滋润深层洁面乳',
				price:'117.00',
				num:'3'
			},
			{
				imgurl:'wap/images/pic/pic1.png',
				name:'泰国 Beauty Buffet Q10牛奶洗面奶 滋润深层洁面乳',
				price:'117.00',
				num:'3'
			},
			{
				imgurl:'wap/images/pic/pic1.png',
				name:'泰国 Beauty Buffet Q10牛奶洗面奶 滋润深层洁面乳',
				price:'117.00',
				num:'3'
			},
			{
				imgurl:'wap/images/pic/pic1.png',
				name:'泰国 Beauty Buffet Q10牛奶洗面奶 滋润深层洁面乳',
				price:'117.00',
				num:'3'
			},
			{
				imgurl:'wap/images/pic/pic1.png',
				name:'泰国 Beauty Buffet Q10牛奶洗面奶 滋润深层洁面乳',
				price:'117.00',
				num:'3'
			}
		]
	},
	methods:{
		search(){
			console.log('开始搜索了....');
		},
		menuItem(index) {
            this.slectIndex = index;
        }
	}
})