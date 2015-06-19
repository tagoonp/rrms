<?php

$host = "localhost";
$user = "root";
//$pass = "0147";
//$pass = "na20v^U+";
$dbname = "timetable";
$pass = '';

mysql_connect($host,$user,$pass)or die("Can not connect server");
mysql_select_db($dbname)or die("Can not connect database");

$cs1 = "SET character_set_results = utf8";
mysql_query($cs1) or die('Error query: ' . mysql_error());

$cs2 = "SET character_set_client = utf8";
mysql_query($cs2) or die('Error query: ' . mysql_error());

$cs3 = "SET character_set_connection = utf8";
mysql_query($cs3) or die('Error query: ' . mysql_error());

?>
