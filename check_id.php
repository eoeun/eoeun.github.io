<?php
	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$res = $mySQLConn->query("SELECT * FROM members WHERE id = '$id'");
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	if($row !== null){
		//echo "<script> alert(\"ID�� �̹� �����մϴ�!\"); history.go(-1);</script>";
		echo "<script> alert(\"ID�� �̹� �����մϴ�!\");</script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		//echo "<script> alert(\"��� ������ ID�Դϴ�!\"); history.go(-1);</script>";
		echo "<script> alert(\"��� ������ ID�Դϴ�!\");</script>";
		mysqli_close($mySQLConn);
		return;
	}
?>