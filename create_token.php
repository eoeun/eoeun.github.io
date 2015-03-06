<?php
	$type = $_POST["type"];
	
	$charArray = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_");
	$token = "";
	if($type === ""){
		return;
	}
	
	for($i = 0; $i < 128; $i++){
		$token .= $charArray[mt_rand(0, 63)];
	}
	
	echo "$token";
	
	//TODO add mySQL registration
	$mySQL = explode(',' , file_get_contents("secure_MySQL.txt"), 2);
	$mySQLConn = new mysqli('localhost', $mySQL[0], $mySQL[1], 'secure_tokens');
	
	if($mySQLConn->connect_error){
		echo "<script> alert(\"로그인에 에러가 발생했습니다!\") </script>";
		exit("connect_error");
	}
	
	switch($type){
		case "id":break;
	}
?>