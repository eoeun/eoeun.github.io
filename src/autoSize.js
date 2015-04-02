"use strict";
function resizeScreen(){
	//document.getElementById("test").innerHTML = window.innerWidth + "," + window.innerHeight;
	
	var navigation = document.getElementById("navigationList").children;
	if(window.innerWidth < 740){
		for(var i = 0; i < navigation.length; i++){
			navigation[i].style.display="block";
		}
		document.getElementById("m_today_text").style.display="inline";
		document.getElementById("today_text").style.display="none";
	}else{
		for(var i = 0; i < navigation.length; i++){
			navigation[i].style.display="inline"
		}
		document.getElementById("today_text").style.display="inline-block";
		document.getElementById("m_today_text").style.display="none";
	}
	
	if(window.innerWidth < 497 && 308 <= window.innerWidth){
		document.getElementById("title").innerHTML = "3-4반에 오신걸<br>환영합니다!";
	}else if(window.innerWidth >= 480){
		document.getElementById("title").innerHTML="3-4반에 오신걸 환영합니다!";
	}else{
		document.getElementById("title").innerHTML = "3-4";
	}
}

function todaySet(){
	/*read("count.txt", function(data){
			var todayText = document.getElementById("today_text");
			var time = new Date().getTime();
			var t;
			var today, total;
			
			if(data === null){
				today = 0;
				total = 0;
				t = new Date().getTime();
			}else{
				var count = data.split(",");
				t = parseInt(count[2]);
				
				if(time - 86400000 > t){
					today = 0;
					t = time;
				}else{
					today = parseInt(count[0]);
				}
				total = parseInt(count[1]);
			}
			today++;
			total++;
			write("count.txt", today+','+total+','+t);
			
			var  text = "Today: "+today+"<br>Total: "+total;
			if(window.innerWidth < 730){
				document.getElementById("m_today_text").innerHTML = text;
			}else{
				 document.getElementById("today_text").innerHTML = text;
			}
		});*/
	$.ajax({
		url: "count.php"
	});
}
