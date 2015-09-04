$(document).ready(function(){ 
		var arr = new Array;
		
		var raffleTime = 0;
		arr["item"] = new Array;
		arr["price"] = new Array;
		arr["weight"] = new Array;
		var jsonPath = confirm("金币抽取点确定，水晶点取消")?"./listCoins.json":"./listJewelry.json";
		// if(confirm("金币抽取点确定，水晶点取消")){
		// 	jsonPath = "./listCoins.json";
		// }else{jsonPath="./listJewelry.json";}
		
		$.getJSON(jsonPath,function(data){ 
			//console.log(data);
			var $jsontip = $("#jsonTip"); 
			var strHtml = "123";//存储数据的变量 
			$jsontip.empty();//清空内容 
			$.each(data,function(infoIndex,info){ 
				$.each(info,function(objIndex,obj){
					strHtml += "道具："+obj["item"]+"<br>"; 
					strHtml += "价格："+obj["price"]+"<br>"; 
					strHtml += "<hr>" ;
					//console.log(obj["weight"]);
					arr["item"][objIndex]=obj["item"];
					arr["price"][objIndex]=obj["price"];
					arr["weight"][objIndex]=obj["weight"];
					//sumWeight += parseFloat(obj["weight"]);//将字符串转化为数字
				})
				
			}) 
			$jsontip.html(strHtml);//显示处理后的数据 
			//console.log(arr["weight"],sumWeight);
		}) 
		
		// for(var x in arr["weight"]){
		// 	
		// 	console.log(arr["weight"]);
		// 	sum += arr["weight"][x];
		// 	console.log(x);	
		// }
		function getSumWeight(num){
if(num>arr["weight"].length){return null;}
var sumWeight = 0;
for(var i=0;i<num;i++){
	sumWeight += parseFloat( arr["weight"][i] );
}
return sumWeight;
		}	
		
		$("#btn1").click(function(){
//for(var i=0;i<100;i++){
///////////////自动一百次/////////////////////
console.log(getSumWeight(23),getSumWeight(arr["weight"].length));
if(raffleTime ===0){$("#jsonTip").empty();var raffle ;}
if(raffleTime<25){
	raffle = Math.random()*getSumWeight(22);
	
}else{
	raffle = Math.random()*getSumWeight(arr["weight"].length);
}

	for(var x in arr["weight"]){
		//console.log(raffle);
		if(raffle<=0){	
//console.log(arr["item"][x],arr["price"][x]);

$("#jsonTip").append("<br/>第"+raffleTime+"次&nbsp;&nbsp;&nbsp;"+arr["item"][x],"&nbsp;&nbsp;&nbsp;"+arr["price"][x]);//用append追加内容
break;//&nbsp;空格转义
		}else{
raffle-=parseFloat(arr["weight"][x]);
		}
	}
raffleTime++;
////////////////////////////////////////////	
//}
//raffleTime=0;		
		})	
	}) 

		