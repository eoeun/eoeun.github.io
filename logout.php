<?php
	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$id = $_SESSION['id'];
	$token = $_SESSION['token'];
	
	$res = mysqli_query($mySQLConn, "SELECT * FROM tokens WHERE id = '$id'");
	
	if(mysqli_num_rows($res) <= 0){
		echo "<script> alert(\"����! ���ɰ����̴�!\\r\\n���� ���� ID�� �α��� �ϽŰǰ���???\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}elseif($token !== mysqli_fetch_row($res)['token']){
		echo "<script> alert(\"�ٸ� �������� ���÷α����Ѱ� �ƴ��� Ȯ���غ�����!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		mysqli_query($mySQLConn, "DELETE FROM tokens WHERE id = '$id'");
	}
	
	mysqli_close($mySQLConn);
		
?>