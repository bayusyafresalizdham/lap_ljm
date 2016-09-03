<?php
	$hostSTTS = "localhost";
	$userSTTS = "root";
	$passSTTS = "";
	$db_STTS = "db_ljm";

	$dbConnSTTS = mysql_connect($hostSTTS,$userSTTS,$passSTTS,true);
	mysql_select_db($db_STTS,$dbConnSTTS);
?>
