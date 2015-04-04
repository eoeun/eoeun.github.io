<?php
	$name = $_POST['name'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$pw = $_POST['pw'];

	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$id_res = mysqli_query($mySQLConn, "SELECT * FROM members WHERE id = '$id'");
	
	if(mysqli_num_rows($id_res) > 0){
		echo "<script> alert(\"기왕이면 Check Ur ID 한번 좀 눌러주시죠?\\r\\n중복 아이디 발견입니다.\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($id, "UTF-8") < 6){
		echo "<script> alert(\"죄송하지만 저희는 6자 이상의 성의있는 ID만 받습니다!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$email_res = $mysqli_query($mySQLConn, "SELECT * FROM members WHERE email = '$email'");
	
	if(mysqli_num_rows($email_res) > 0){
		echo "<script> alert(\"언젠가 이 이메일로 가입해보시지 않았나요?\\r\\n이 이메일 주소는 가입되어있는 주소네요!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script> alert(\"이메일 주소로 장난은 이제 그만!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$name_res = mysqli_query($mySQLConn, "SELECT * FROM members WHERE name= '$name'");
	
	if(mysqli_num_rows($name_res) > 0){
		echo "<script> alert(\"축하드립니다! 동명이인 발견!\\r\\n근데 헷갈릴 수도 있을거 같은데 죄송하지만 뒤에 1이라도 붙여보시겠어요?\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($name, "UTF-8") < 2){
		echo "<script> alert(\"설마 이름이 없는건 아니겠죠?\\r\\n이름은 최소 2글자 이상이어야 합니다.\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	/*if(mb_strlen($pw) < 7){
		echo "<script> alert(\"보안이 위험하다!\\r\\n비밀번호는 7자 이상은 되어야 그나마 안전하다고 생각하시지 않으신가요?\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}*/
	//when pw = ""
	if($pw == "cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e"){
		echo "<script> alert(\"자바스크립트 편집해서 비밀번호가지고 장난치지 말아주실래요?\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$pw = hash("sha512", $pw, false);
	
	$class = UserClass::EMAIL_NOT_VERIFIED;
	mysqli_query($mySQLConn, "INSERT INTO members (id, name, email, pw, class) VALUES ('$id', '$name', '$email', '$pw', '$class')");
	
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