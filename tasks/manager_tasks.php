<?php 

if(isset($_FILES)){
	
	$tmp_name = $_FILES['my_file']['tmp_name'];
	$name  = $_FILES['my_file']['name'];
	move_uploaded_file($tmp_name, dirname(__FILE__) .'\\' . $name);
}else{
	echo 'no lsjfsldkjflsdkj ';
}


?>