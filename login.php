<?php
	$id = $_POST["id"];
	$pw = $_POST["pw"];
	
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";

	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"�α��ο� ������ �߻��߽��ϴ�! (500 ���� ���� ����)\\r\\n������ �� ���� ���ݸ� ��ٷ��ּ���!\"); history.go(-1); </script>";
		exit("connect_error");
	}
	
	$res = $mySQLConn->query("SELECT * FROM members WHERE id='$id'");
	
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	if($row === null || hash("sha512", $pw, false) !== $row['pw']){
		mysqli_close($mySQLConn);
		echo "<script> alert(\"���� �� ID Ȥ�� ��й�ȣ�� �߸��ƴ�.\"); history.go(-1); </script>";
		return;
		
	}else{
		$charArray = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_");
		$token = "";
		
		if($type === ""){
			return;
		}
		
		for($i = 0; $i < 256; $i++){
			$token .= $charArray[mt_rand(0, 63)];
		}
		
		$tokenResult = $mySQLConn->query("SELECT * FROM tokens WHERE id='$id'");
		if($tokenResult->fetch_array(MYSQLI_ASSOC) == null){
			$mySQLConn->query("INSERT INTO tokens (id, token) VALUES ('$id', '$token')");
		}else{
			$mySQLConn->query("UPDATE tokens SET token = '$token' WHERE id='$id'");
		}
		
		session_start();
		$_SESSION['token'] = $token;
		mysqli_close($mySQLConn);
		
	}
?>