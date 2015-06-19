<?php
session_start();

require("../../database/connect.class.php");
$db = new database();
$db->connect();

$sessionKey = $db->getSessionkey();

if(isset($_SESSION['userSession_'.$sessionKey])){
	if($_SESSION['user_'.$sessionKey]==''){
		header('Location: ../../signout.php');
		exit();
	}
}else{
	header('Location: ../../signout.php');
	exit();
}


if(isset($_SESSION['user_'.$sessionKey])){
	switch($_SESSION['usertype_'.$sessionKey]){
		case '1': header('Location: ../../admin/index.php'); break;
		case '2': header('Location: ../../staff/index.php'); break;
		default: header('Location: ../../signout.php');
	}
}else{
	header('Location: ../signout.php');
	exit();
}
?>
