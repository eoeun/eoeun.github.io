<?php
	$name = $_POST['name'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$pw = $_POST['pw'];

	$query_id = "MYSQLID";
	$query_pw = "MYSQLPW";
	
	$mySQLConn = new mysqli('localhost', $query_id, $query_pw, 'secure_logins');
	
	if($mySQLConn->$connect_error){
		echo "<script> alert(\"ó�� �߿� ������ �߻��߽��ϴ�! (500 ���� ���� ����)\\r\\n������ �� ���� ���ݸ� ��ٷ��ּ���!\"); history.go(-1); </script>";
		return;
	}
	
	$id_res = $mySQLConn->query("SELECT * FROM members WHERE id = '$id'");
	$id_row = $id_res->fetch_array(MYSQLI_ASSOC);
	
	if($row !== null){
		echo "<script> alert(\"����̸� Check Ur ID �ѹ� �� �����ֽ���?\\r\\n�ߺ� ���̵� �߰��Դϴ�.\"); history.go(-1);</script>";
		return;
	}
	
	if(mb_strlen($id, "UTF-8") < 6){
		echo "<script> alert(\"�˼������� ����� 6�� �̻��� �����ִ� ID�� �޽��ϴ�!\"); history.go(-1);</script>";
		return;
	}
	
	$email_res = $mySQLConn->query("SELECT * FROM members WHERE email = '$email'");
	$email_row = $email_res->fetch_array(MYSQLI_ASSOC);
	
	if($email_row !== null){
		echo "<script> alert(\"������ �� �̸��Ϸ� �����غ����� �ʾҳ���?\\r\\n�� �̸��� �ּҴ� ���ԵǾ��ִ� �ּҳ׿�!\"); history.go(-1);</script>";
		return;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script> alert(\"�̸��� �ּҷ� �峭�� ���� �׸�!\"); history.go(-1); </script>";
		return;
	}
	
	$name_res = $mySQLConn->query("SELECT * FROM members WHERE name= '$name'");
	$name_row = $name_res->fetch_array(MYSQLI_ASSOC);
	
	if($name_row !== null){
		echo "<script> alert(\"���ϵ帳�ϴ�! �������� �߰�!\\r\\n�ٵ� �򰥸� ���� ������ ������ �˼������� �ڿ� 1�̶� �ٿ����ðھ��?\"); history.go(-1);</script>";
		return;
	}
	
	if(mb_strlen($name, "UTF-8") < 2){
		echo "<script> alert(\"���� �̸��� ���°� �ƴϰ���?\\r\\n�̸��� �ּ� 2���� �̻��̾�� �մϴ�.\"); history.go(-1); </script>";
		return;
	}
	
	if(mb_strlen($pw) < 7){
		echo "<script> alert(\"������ �����ϴ�!\\r\\n��й�ȣ�� 7�� �̻��� �Ǿ�� �׳��� �����ϴٰ� �����Ͻ��� �����Ű���?\"); history.go(-1); </script>";	
	}
	
	$pw = hash("sha512", $pw, false);
	$mySQLConn->query("INSERT INTO members (id, name, email, pw) VALUES ('$id', '$name', '$email', '$pw')");
	
	mysqli_close($mySQLConn);
	
	echo "<script> alert(\"���� ����! �α��� ���ֽŴ��� �����λ�� �÷��ּ���!\\r\\n������ �������� Ȱ���� ���ؼ��� �̸��Ϻ��� �������ּž� �ϴ°� �ƽ���?\"); history.go(-1);</script>";
	return;
?>