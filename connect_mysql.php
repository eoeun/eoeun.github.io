<?php
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	$mySQLConn = mysqli_connect("localhost", $query_id, $query_pw);
	
	if($mySQLConn->$connect_error){
		die("서버와 연결에 실패했습니다! 고쳐질 때 까지 조금만 기다려주세요! (".mysqli_error($mySQLConn).")");
	}
?>