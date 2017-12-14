<?php
	$connection = mysql_connect("localhost","root","venky");
	$connection2 = mysql_select_db("store");
	if($connection && $connection2){
		//echo "connection succes";
	}else{
		echo "database connection failed";
	}
	
?>
