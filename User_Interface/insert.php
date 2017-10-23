<?php 
// connect to other file
require 'db/connect.php';
require 'db/security.php';


// Store the records we want to output
$records =array();
$status = array();

//check input is not empty
if(!empty($_POST)){
	if(isset($_POST['TestName'],$_POST['Last_name'])){
		$TestName = trim($_POST['TestName']);
		$Last_name  = trim($_POST['Last_name']);
		if(!empty($TestName) && !empty($Last_name)){
		$insert = $db->prepare("INSERT INTO testconfig(CfgName,Last_name) VALUES (?,?)");
		//$insert ->bind_param('ss',$First_name,$Last_name);
			if($insert->execute()){
				header('Location: index.php');
				die();
			}		
		}	
	}
}

?>