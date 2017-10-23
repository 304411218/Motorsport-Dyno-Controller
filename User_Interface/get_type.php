 <?php  
 //load_data.php  
 $connect = mysqli_connect("localhost", "root", "", "dyno");  
 $output = '';  


 /*if(!empty($_POST)){
	if(isset($_POST['First_name'],$_POST['Last_name'])){
		$First_name = trim($_POST['First_name']);
		$Last_name  = trim($_POST['Last_name']);
		if(!empty($First_name) && !empty($Last_name)){
		$insert = $db->prepare("INSERT INTO people(First_name,Last_name,created) VALUES (?,?,NOW())");
		$insert ->bind_param('ss',$First_name,$Last_name);
			if($insert->execute()){
				header('Location: index.php');
				die();
			}		
		}	
	}
}
 */
 if(isset($_POST["type_id"]))  
 {  

           $sql = "SELECT SP.VarName FROM dyno.testtype TT, dyno.controlvar SP WHERE TT.idTType = '".$_POST["type_id"] . "' AND TT.TSetpoint = SP.idVar;";


      $result = mysqli_query($connect, $sql);  
	  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div>'.$row["VarName"].'</div>';
	   
      }  
	  
	  echo "<form method='post'>";
	  echo "TestName ";
	  echo "<input name='TestName' type='text'/><br/><br/>";
      echo "$output minimum ";
	  echo "<input name='min' type='text'/><br/><br/>";
	  echo "$output Maximum ";
	  echo "<input name='max' type='text'/><br/>";
	  echo "<input type='submit' name='Submit' value='insert'>";
 }  
 ?>  