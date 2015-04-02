<?php
	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	
	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"로그아웃에 에러가 발생했습니다! (500 내부 서버 오류)\\r\\n고쳐질 때 까지 조금만 기다려주세요!\"); history.go(-1); </script>";
		return;
	}
	$id = $_SESSION['id'];
	
	$res = $mySQLConn->query("SELECT * FROM tokens WHERE id = '$id'");
	
	$token = $res->fetch_array(MYSQLI_ASSOC);
	
	if($token == null){
		echo "<script> alert(\"히익! 유령계정이다!\\r\\n현재 무슨 ID로 로그인 하신건가요???\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}elseif($token !== $res['token']){
		echo "<script> alert(\"다른 계정에서 동시로그인한게 아닌지 확인해보세요!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}else{
		$mySQLConn->query("DELETE FROM tokens WHERE id = '$id'");
	}
	
	mysqli_close($mySQLConn);
		
?>