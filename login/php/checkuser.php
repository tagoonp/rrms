<?php
session_start();
require("../../database/connect.class.php");
$db = new database();
$db->connect();

$sessionKey = $db->getSessionkey();

$strSQL = "SELECT * FROM tb_useraccount WHERE username = '".$_POST['username']."' and password = '".md5($_POST['password'])."' and user_status = 'Yes'";
$resultUser = $db->select($strSQL,false,true);
if($resultUser){
	$_SESSION['userSession_'.$sessionKey] = session_id();
	$_SESSION['user_'.$sessionKey] = $_POST['username'];
	$_SESSION['usertype_'.$sessionKey] = $resultUser[0]['usertype_id'];
	session_write_close();

	print "Y";
}else{
	print "User account not available!";
	print $strSQL;
}
?>
