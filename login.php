<?php
	$id = $_POST["id"];
	$pw = $_POST["pw"];
	
	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$res = mysqli_query($mySQLConn, "SELECT * FROM members WHERE id='$id'");
	
	if(mysqli_num_rows($res) <= 0){
		mysqli_close($mySQLConn);
		echo "<script> alert(\"역시 내 ID 혹은 비밀번호는 잘못됐다.\"); history.go(-1); </script>";
		return;
	}
	
	
	$row = mysqli_fetch_row($res);

	if(hash("sha512", $pw, false) !== $row['pw']){
		mysqli_close($mySQLConn);
		echo "<script> alert(\"역시 내 ID 혹은 비밀번호는 잘못됐다.\"); history.go(-1); </script>";
		return;
	}else{
		$charArray = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_");
		$token = "";
		
		for($i = 0; $i < 256; $i++){
			$token .= $charArray[mt_rand(0, 63)];
		}
		
		$tokenResult = $mysqli_query($mySQLConn, "SELECT * FROM tokens WHERE id='$id'");
		if(mysqli_num_row($tokenResult) <= 0){
			mysqli_query($mySQLConn, "INSERT INTO tokens (id, token) VALUES ('$id', '$token')");
		}else{
			mysqli_query($mySQLConn, "UPDATE tokens SET token = '$token' WHERE id='$id'");
		}
		
		session_start();
		$_SEESION['id'] = $id;
		$_SESSION['token'] = $token;
		mysqli_close($mySQLConn);
		
	}
?>