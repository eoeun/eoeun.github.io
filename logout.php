<?php
	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$id = $_SESSION['id'];
	$token = $_SESSION['token'];
	
	$res = mysqli_query($mySQLConn, "SELECT * FROM tokens WHERE id = '$id'");
	
	if(mysqli_num_rows($res) <= 0){
		echo "<script> alert(\"히익! 유령계정이다!\\r\\n현재 무슨 ID로 로그인 하신건가요???\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}elseif($token !== mysqli_fetch_row($res)['token']){
		echo "<script> alert(\"다른 계정에서 동시로그인한게 아닌지 확인해보세요!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		mysqli_query($mySQLConn, "DELETE FROM tokens WHERE id = '$id'");
	}
	
	mysqli_close($mySQLConn);
		
?>