<?php
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	
	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"�α׾ƿ��� ������ �߻��߽��ϴ�! (500 ���� ���� ����)\\r\\n������ �� ���� ���ݸ� ��ٷ��ּ���!\"); history.go(-1); </script>";
		return;
	}
	$id = $_SESSION['id'];
	
	$res = $mySQLConn->query("SELECT * FROM tokens WHERE id = '$id'");
	
	$token = $res->fetch_array(MYSQLI_ASSOC);
	
	if($token == null){
		echo "<script> alert(\"����! ���ɰ����̴�!\\r\\n���� ���� ID�� �α��� �ϽŰǰ���???\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}elseif($token !== $res['token']){
		echo "<script> alert(\"�ٸ� �������� ���÷α����Ѱ� �ƴ��� Ȯ���غ�����!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		$mySQLConn->query("DELETE FROM tokens WHERE id = '$id'");
	}
	
	mysqli_close($mySQLConn);
		
?>