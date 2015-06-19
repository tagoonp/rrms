<?php
if(isset($_SESSION['userSession_'.$sessionKey])){
  if($_SESSION['userSession_'.$sessionKey]!=session_id()){
    header('Location: ./../signout.php');
    exit();
  }else{
    if($_SESSION['user_'.$sessionKey]==''){
  		header('Location: ./../signout.php');
  		exit();
  	}
  }

}else{
	header('Location: ./../signout.php');
	exit();
}

?>
