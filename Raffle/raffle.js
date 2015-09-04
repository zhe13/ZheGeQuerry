$(document).ready(function(){ 
	    //-----------global variables-------------
		var raffleTime = 0;
		var arr = new Array;
		var jsonPath = confirm("金币抽取点确定，水晶点取消")?"./listCoins.json":"./listJewelry.json";
		//-----------global variables-------------
		$.getJSON(jsonPath,function(data){ 
			var $jsontip = $("#jsonTip"); 
			var strHtml = "lovePolly";//存储数据的变量 
			$jsontip.empty();//清空内容 
			$.each(data,function(infoIndex,info){ 
				$.each(info,function(objIndex,obj){
					arr[objIndex]=obj;
					strHtml += "道具："+obj["item"]+"<br>"; 
					strHtml += "价格："+obj["price"]+"<br>"; 
					strHtml += "<hr>" ;					
					//console.log(arr[objIndex]["item"]);
				})
			}) 
			$jsontip.html(strHtml);//显示处理后的数据 
		}) 
		
		$("#btn1").click(function(){
			getItem();
		})
		$("#btn2").click(function(){
			for(var i=0;i<100;i++){
			///////////////自动一百次/////////////////////
			getItem();	
			}
			raffleTime=0;		
		})

		
		//获取权重总和的函数
		function getSumWeight(num){
			if(num>arr.length){return null;}
			var sumWeight = 0;
			for(var i=0;i<num;i++){
				sumWeight += parseFloat( arr[i]["weight"] );
			}
			return sumWeight;
		}
		
		//抽取方法1，权重＋区间
		function getItem(){
			if(raffleTime ===0){$("#jsonTip").empty();var raffle ;}
			if(raffleTime<25){
				raffle = Math.random()*getSumWeight(22);			
			}else{
				raffle = Math.random()*getSumWeight(arr.length);
			}
			
				for(var x in arr){
					if(raffle<=0){	
						$("#jsonTip").append("<br/>第"+raffleTime+"次&nbsp;&nbsp;&nbsp;"+arr[x]["item"],"&nbsp;&nbsp;&nbsp;"+arr[x]["price"]);//用append追加内容
						break;//&nbsp;空格转义
					}else{
						raffle-=parseFloat(arr[x]["weight"]);
					}
				}
			raffleTime++;
		}
				
	}) 

		