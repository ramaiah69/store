<?php
	date_default_timezone_set("Asia/Calcutta");
	if(isset($_SESSION['email']) && isset($_SESSION['type'])){
		$authenticated = true;
		$type = $_SESSION['user_type'];
		if($type == 'admin'){
			$user_type = 'admin';
		}else{
			$user_type = 'shop_keeper';
		}
	}else{
		$authenticated = false;
	}
?>