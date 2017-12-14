<?php
require 'connect.php';
	$code = mysql_real_escape_string($_POST['code']);
	$query = mysql_query("select * from products where code = '$code'");
	$data = array();
	$data[] = mysql_fetch_array($query);
	$result = json_encode($data);
	echo $result;
?>