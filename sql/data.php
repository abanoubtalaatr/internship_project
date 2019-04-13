<?php 
session_start();
class data{

public function connect ($databaseName = 'project'){
		  $dsn ="mysql:host=localhost;dbname=$databaseName";
		  $user = 'root';
		  $pass ='';
		  $option = array(\PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');

		  try{
			    $con = new \PDO($dsn,$user,$pass,$option);
			    $con ->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
			   return $con;
		   }
		  catch(\PDOException $e){
		    echo 'you fail to connect to your databse'.$e ->getMessage();
		    
		  }
	}


 //function to get information about this table you want
 public function get_information($table){
 	
 	$satement = self::connect()->prepare("SELECT * FROM $table 
 		WHERE '{$_SESSION['id']}'");
         $satement->execute(); 
        $row =$satement ->fetchAll(\PDO::FETCH_ASSOC);
        return $row;
 }// get_information

 

}//data
 
?>