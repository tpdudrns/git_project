<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

	$servername = "192.168.56.1";
    $username = "sydb";
    $password = "cj642djk82t3qj9t3aydyre8gwjqma585yfd9kef"; 
    $dbname = "myDB"; 

	// localhost = DB주소, web=DB계정아이디, 1234=DB계정비밀번호, post_board="DB이름"
	$db = new mysqli("192.168.56.1","sydb","cj642djk82t3qj9t3aydyre8gwjqma585yfd9kef","myDB"); 
	$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}
	$connect = new PDO("mysql:host=192.168.56.1;dbname=myDB", "sydb", "cj642djk82t3qj9t3aydyre8gwjqma585yfd9kef")
?>