<?php
	require "connect.php";
	function purchaseItemsAdd($connection,$id,$code,$quantity,$unitPrice,$totalPrice){
		$query = mysql_query("insert into purchaseitems (id,code,quantity,unitPrice,totalPrice) values ('$id','$code','$quantity','$unitPrice','$totalPrice')");
		$query2 = mysql_query("select quantity from products where code='$code'");
		$data = mysql_fetch_array($query2);
		$oldQuantity = $data[0];
		$newQuantity = $oldQuantity - $quantity;

		$query2 = mysql_query("update products set quantity='$newQuantity' where code='$code'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function purchaseAdd($connection,$id,$totalItems,$price,$shopKeeperEmail,$date){
		$query = mysql_query("insert into purchases (id,totalItems,price,shopKeeperEmail,date) values ('$id','$totalItems','$price','$shopKeeperEmail','$date')");
		if($query){
			return true;
		}else{
			return false;
		}
	}
?>