<?php
	$type = $_POST["type"];
	
	$charArray = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_");
	$token = "";
	if($type === ""){
		return;
	}
	
	for($i = 0; $i < 128; $i++){
		$token .= $charArray[mt_rand(0, 127)];
	}
	
	echo "$token";
	
	//TODO add mySQL registration
	switch($type){
		case "id":break;
	}
?>