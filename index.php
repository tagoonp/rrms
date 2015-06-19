<?php
session_start();

include "database/connect.class.php";

$db = new database();
$sessionprefix = $db->getSessionkey();

// If session id of system available
if(isset($_SESSION['userSession_'.$sessionKey]){
  if($_SESSION['userSession_'.$sessionKey] != session_id()){
    header('Location: signout.php');
    exit();
  }else{

    if($_SESSION['user_'.$sessionKey]==''){
    	header('Location: signout.php');
    	exit();
    }else{
      header('Location: /login/php/authen.php');
      exit();
    }
  }
}else{
  header('Location: /login/');
  exit();
}
?>
