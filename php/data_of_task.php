<?php 

require_once '../sql/data.php';


 $data = new data();

 $info =  $data->get_information('tasks');
 $real_data = [];

foreach ($info as $key => $value) {

	$real_data [] = $value['description'];
	$real_data [] = $value['start_task'];
	$real_data [] = $value['end_task'];
}
// date_default_timezone_set('Africa/Cairo');

// if(date("Y-m-d h:i:s") > $real_data[2]){
//   echo 'yes sir is finshied your task ';
  
// }else{
// 	echo 'now you still can solve';
// }




echo json_encode($real_data);




?>