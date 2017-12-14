<?php
	function productAdd($connection,$name,$code,$mrp,$quantityType,$date){
		$query = mysql_query("insert into products (name,code,mrp,quantityType,date) values ('$name','$code','$mrp','$quantityType','$date')");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function productEdit($connection,$name,$code,$mrp,$quantityType,$date){
		$query = mysql_query("update products set name='$name',code='$code',mrp='$mrp',quantityType='$quantityType',date='$date' where code='$code'");
		
		if($query){
			return $query;
		}else{
			return $query;
		}
	}
	
	
	function checkCodeExists($connection,$code){
		$query = mysql_query("select code from products where code='$code'");
		if(mysql_num_rows($query)){
			return true;
		}else{
			return false;
		}
	}
	function quantityModity($connection,$code,$adjustmentValue,$adjustmentType,$note,$date){
		$query = mysql_query("insert into quantityAdjustments (code,adjustmentType,adjustmentValue,note,date) values ('$code','$adjustmentType','$adjustmentValue','$note','$date')");
		//getting old quantity
		$q = mysql_query("select quantity from products where code='$code'");
		$data = mysql_fetch_array($q);
		$oldQuantity = $data[0];

		if($adjustmentType == "addition"){
			$newQuantity = $oldQuantity + $adjustmentValue;
		}else{
			$newQuantity = $oldQuantity - $adjustmentValue;
		}

		$query2 = mysql_query("update products set quantity = '$newQuantity' where code='$code'");
		if($query && $query2){
			return true;
		}else{
			return false;
		}
	}
?>