 <?php  
//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////																								//////
/////									Version 1.1													//////
/////							This Scirpt is not finished											//////
//////////////////////////////////////////////////////////////////////////////////////////////////////////		
 
 //load_data.php  
 $connect = mysqli_connect("localhost", "root", "", "dyno");  
 $output = '';  
 

   if (empty($_POST["type_id"])) {
       echo "Please select TEST type <br/><br/>";

  } else{

 if(isset($_POST["type_id"]))  
 {  

           $sql = "SELECT SP.VarName FROM dyno.testtype TT, dyno.controlvar SP WHERE TT.idTType = '".$_POST["type_id"] . "' AND TT.TSetpoint = SP.idVar;";


      $result = mysqli_query($connect, $sql);  
	  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div>'.$row["VarName"].'</div>';
	   
      }  
	  
	echo "<form name='config' method='post' action='insert.php'>";
	echo "TestName ";
	echo "<input name='TestName' type='text'/><br/><br/>";
    echo "$output Minimum";
	echo "<input name='min' type='text'/><br/><br/>";
	echo "$output Maximum";
	echo "<input name='max' type='text'/><br/>";
	echo "<input type='submit' name='submit-testconfig' value='Set New Profile'>";
	echo "</form>";
	  
	  
 }  
  }

 ?>  
