<?php
require 'connect.php';
	$hint = mysql_real_escape_string($_POST['hint']);
	$query = mysql_query("select code,name from products where name like '%$hint%' or code like '%$hint%'");
	$data = array();
	while($row = mysql_fetch_assoc($query)){
		$data[] = $row;
	}
	$result = json_encode($data);
	echo $result;
?>