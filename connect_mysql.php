<?php
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	$mySQLConn = mysqli_connect("localhost", $query_id, $query_pw);
	
	if($mySQLConn->$connect_error){
		die("������ ���ῡ �����߽��ϴ�! ������ �� ���� ���ݸ� ��ٷ��ּ���! (".mysqli_error($mySQLConn).")");
	}
?>