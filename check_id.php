<?php
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	
	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"ID üũ�� ������ �߻��߽��ϴ�! (500 ���� ���� ����)\\r\\n������ �� ���� ���ݸ� ��ٷ��ּ���!\"); history.go(-1); </script>";
		return;
	}
	
	$res = $mySQLConn->query("SELECT * FROM members WHERE id = '$id'");
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	if($row !== null){
		echo "<script> alert(\"ID�� �̹� �����մϴ�!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		echo "<script> alert(\"��� ������ ID�Դϴ�!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
?>