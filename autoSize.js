"use strict";
function resizeScreen(){
	//document.getElementById("test").innerHTML = window.innerWidth + "," + window.innerHeight;
	
	var navigation = document.getElementById("navigationList").children;
	if(window.innerWidth < 730){
		for(var i = 0; i < navigation.length; i++){
			navigation[i].style.display="block";
		}
		
	}else{
		for(var i = 0; i < navigation.length; i++){
			navigation[i].style.display="inline"
		}
	}
	
	if(window.innerWidth < 480 && 308 <= window.innerWidth){
		document.getElementById("title").innerHTML = "3-4반에 오신걸<br>환영합니다!";
	}else if(window.innerWidth >= 480){
		document.getElementById("title").innerHTML="3-4반에 오신걸 환영합니다!";
	}else{
		document.getElementById("title").innerHTML = "3-4";
	}
}