<?php
	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$res = $mySQLConn->query("SELECT * FROM members WHERE id = '$id'");
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	if($row !== null){
		//echo "<script> alert(\"ID가 이미 존재합니다!\"); history.go(-1);</script>";
		echo "<script> alert(\"ID가 이미 존재합니다!\");</script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		//echo "<script> alert(\"사용 가능한 ID입니다!\"); history.go(-1);</script>";
		echo "<script> alert(\"사용 가능한 ID입니다!\");</script>";
		mysqli_close($mySQLConn);
		return;
	}
?>