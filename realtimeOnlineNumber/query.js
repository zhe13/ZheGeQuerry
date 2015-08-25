//data	:	2015-08-23
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	QueryRealtimeOnline
//

$(document).ready(function(){
	update();
	setInterval(update,5000);
	
})
//使用ajax和php通讯
function update() {
	$.getJSON("test1.php?jsonp=?",function(data) {
		createNumber(data.n);
	});
};
//我们要定义一个动画过程，使用jQuery的animate()函数实现从一个数字到另一个数字的变换过程：
function createNumber(value) {
	var num = $("#number");
	num.animate({count : value},{
		duration:500,
		step:function() {
			num.text(String(parseInt(this.count)));
		}
	});
};