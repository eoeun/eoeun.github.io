<?php
	$name = $_POST['name'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$pw = $_POST['pw'];

	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	
	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"처리 중에 에러가 발생했습니다! (500 내부 서버 오류)\\r\\n고쳐질 때 까지 조금만 기다려주세요!\"); history.go(-1); </script>";
		return;
	}
	
	$id_res = $mySQLConn->query("SELECT * FROM members WHERE id = '$id'");
	$id_row = $id_res->fetch_array(MYSQLI_ASSOC);
	
	if($row !== null){
		echo "<script> alert(\"기왕이면 Check Ur ID 한번 좀 눌러주시죠?\\r\\n중복 아이디 발견입니다.\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($id, "UTF-8") < 6){
		echo "<script> alert(\"죄송하지만 저희는 6자 이상의 성의있는 ID만 받습니다!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$email_res = $mySQLConn->query("SELECT * FROM members WHERE email = '$email'");
	$email_row = $email_res->fetch_array(MYSQLI_ASSOC);
	
	if($email_row !== null){
		echo "<script> alert(\"언젠가 이 이메일로 가입해보시지 않았나요?\\r\\n이 이메일 주소는 가입되어있는 주소네요!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script> alert(\"이메일 주소로 장난은 이제 그만!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$name_res = $mySQLConn->query("SELECT * FROM members WHERE name= '$name'");
	$name_row = $name_res->fetch_array(MYSQLI_ASSOC);
	
	if($name_row !== null){
		echo "<script> alert(\"축하드립니다! 동명이인 발견!\\r\\n근데 헷갈릴 수도 있을거 같은데 죄송하지만 뒤에 1이라도 붙여보시겠어요?\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($name, "UTF-8") < 2){
		echo "<script> alert(\"설마 이름이 없는건 아니겠죠?\\r\\n이름은 최소 2글자 이상이어야 합니다.\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($pw) < 7){
		echo "<script> alert(\"보안이 위험하다!\\r\\n비밀번호는 7자 이상은 되어야 그나마 안전하다고 생각하시지 않으신가요?\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$pw = hash("sha512", $pw, false);
	
	$class = UserClass::EMAIL_NOT_VERIFIED;
	$mySQLConn->query("INSERT INTO members (id, name, email, pw, class) VALUES ('$id', '$name', '$email', '$pw', '$class')");
	
	mysqli_close($mySQLConn);
	
	echo "<script> alert(\"가입 성공! 로그인 해주신다음 가입인사라도 올려주세요!\\r\\n참조로 정상적인 활동을 위해서는 이메일부터 인증해주셔야 하는거 아시죠?\"); history.go(-1);</script>";
	return;
	
	abstract class UserClass
	{
		const EMAIL_NOT_VERIFIED = 0;
		const DEFAULT_USER = 1;
		const ADMIN = 2;
	}
?>