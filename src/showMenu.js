/*
*3-4 Show section
*/
"use strict";

var  currentlyShown = "none";

function showDocument(){
	if(currentlyShown == "document"){
		document.getElementById("document").style.display="none";
		currentlyShown = "none";
	}else{
		document.getElementById("document").style.display = "inline";
		currentlyShown = "document";
	}
}

function showBoard(){

}

function showAbout(){

}

function showPoll(){

}

function showToDo(){

}

function showLogin(){

}
