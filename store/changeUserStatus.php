<?php
require "connect.php";
	$email = $_POST['email'];
	$type = $_POST['type'];
	if($type == 'activate'){
		$query = mysql_query("update users set status = 1 where email = '$email'");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}else{
		$query = mysql_query("update users set status = 0 where email = '$email'");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
	
?>