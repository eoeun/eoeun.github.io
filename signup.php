<?php
	$name = $_POST['name'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$pw = $_POST['pw'];

	include "connect_mysql.php";
	mysqli_select_db($mySQLConn, "secure_logins");
	
	$id_pattern = "/[^0-9a-zA-Z\-_]+/";
	
	if(preg_match($id_pattern, $id)){
		echo "<script> alert(\"ID�� ���Ұ��� ���ڰ� ����ֽ��ϴ�!\"); history.go(-1);</script>";
		return;
	}
	
	$id_res = mysqli_query($mySQLConn, "SELECT * FROM members WHERE id = '$id'");
	
	if(mysqli_num_rows($id_res) > 0){
		echo "<script> alert(\"����̸� Check Ur ID �ѹ� �� �����ֽ���?\\r\\n�ߺ� ���̵� �߰��Դϴ�.\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($id, "UTF-8") < 6){
		echo "<script> alert(\"�˼������� ����� 6�� �̻��� �����ִ� ID�� �޽��ϴ�!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$email_res = $mysqli_query($mySQLConn, "SELECT * FROM members WHERE email = '$email'");
	
	if(mysqli_num_rows($email_res) > 0){
		echo "<script> alert(\"������ �� �̸��Ϸ� �����غ����� �ʾҳ���?\\r\\n�� �̸��� �ּҴ� ���ԵǾ��ִ� �ּҳ׿�!\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script> alert(\"�̸��� �ּҷ� �峭�� ���� �׸�!\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$name_res = mysqli_query($mySQLConn, "SELECT * FROM members WHERE name= '$name'");
	
	if(mysqli_num_rows($name_res) > 0){
		echo "<script> alert(\"���ϵ帳�ϴ�! �������� �߰�!\\r\\n�ٵ� �򰥸� ���� ������ ������ �˼������� �ڿ� 1�̶� �ٿ����ðھ��?\"); history.go(-1);</script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	if(mb_strlen($name, "UTF-8") < 2){
		echo "<script> alert(\"���� �̸��� ���°� �ƴϰ���?\\r\\n�̸��� �ּ� 2���� �̻��̾�� �մϴ�.\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	/*if(mb_strlen($pw) < 7){
		echo "<script> alert(\"������ �����ϴ�!\\r\\n��й�ȣ�� 7�� �̻��� �Ǿ�� �׳��� �����ϴٰ� �����Ͻ��� �����Ű���?\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}*/
	//when pw = ""
	if($pw == "cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e"){
		echo "<script> alert(\"�ڹٽ�ũ��Ʈ �����ؼ� ��й�ȣ������ �峭ġ�� �����ֽǷ���?\"); history.go(-1); </script>";
		mysqli_close($mySQLConn);
		return;
	}
	
	$pw = hash("sha512", $pw, false);
	
	$class = UserClass::EMAIL_NOT_VERIFIED;
	mysqli_query($mySQLConn, "INSERT INTO members (id, name, email, pw, class) VALUES ('$id', '$name', '$email', '$pw', '$class')");
	
	mysqli_close($mySQLConn);
	
	echo "<script> alert(\"���� ����! �α��� ���ֽŴ��� �����λ�� �÷��ּ���!\\r\\n������ �������� Ȱ���� ���ؼ��� �̸��Ϻ��� �������ּž� �ϴ°� �ƽ���?\"); history.go(-1);</script>";
	return;
	
	abstract class UserClass
	{
		const EMAIL_NOT_VERIFIED = 0;
		const DEFAULT_USER = 1;
		const ADMIN = 2;
	}
?>