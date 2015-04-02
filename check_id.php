<?php
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	
	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"ID 체크에 에러가 발생했습니다! (500 내부 서버 오류)\\r\\n고쳐질 때 까지 조금만 기다려주세요!\"); history.go(-1); </script>";
		return;
	}
	
	$res = $mySQLConn->query("SELECT * FROM members WHERE id = '$id'");
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	if($row !== null){
		echo "<script> alert(\"ID가 이미 존재합니다!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		echo "<script> alert(\"사용 가능한 ID입니다!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
?>