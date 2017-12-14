<?php

	function checkLogin($connection,$table,$email,$password){
		
		$query = mysql_query("select * from $table where email='$email' and password='$password'");
		if(mysql_num_rows($query)){
			$data = mysql_fetch_array($query);
			if($data['status'] == 0){
				return 2;
			}else{
				return 1;
			}
			
		}else{
			return 0;
		}
	}
	function checkValidUser($table,$email){
		$query = mysql_query("select * from $table where email='$email'");
		if(mysql_num_rows($query)){
			return 1;
		}else{
			return 0;
		}
	}
	function forgotPassword($table,$email,$password){
		$query = mysql_query("update $table set password='$password' where email='$email");
		$query = mysql_query("select * from $table where email='$email' and password='$password'");
		if(mysql_num_rows($query)){
			return 1;
		}else{
			return 0;
		}
	}
	function userType($connection,$email){
		$query = mysql_query("select role from users where email = '$email'");
		$data = mysql_fetch_array($query);
		return $data[0];
	}
	function test_input($data) 
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
?>