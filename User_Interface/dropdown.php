
<?php 
//////////////////////////////////////////////////////////////////////////////////////////////////////////
/////																								//////
/////									Version 1.1													//////
/////																								//////
//////////////////////////////////////////////////////////////////////////////////////////////////////////			



// connect to other file
include 'db/connect.php';
include 'db/security.php';

/*
$combine = "SELECT 
    TT.idTType      AS 'Test ID',
    TT.TName        AS 'Test Name',
    SP.VarName      AS 'Sweep variable',
    CS.SeriesName   AS 'Sweep Index',
    CP.VarName      AS 'control output',
    FP.VarName      AS 'fixed parameter',
    OP.VarName      AS 'result',
    TT.TDescription AS 'Description'
FROM
    dyno.testtype      TT,
    dyno.controlseries CS,
    dyno.controlvar    SP,
    dyno.controlvar    CP,
    dyno.controlvar    FP,
    dyno.controlvar    OP
WHERE
		TT.TSetpoint = SP.idVar
	AND TT.TSeries   = CS.idSeries
	AND TT.TControl  = CP.idVar
	AND TT.TFixed    = FP.idVar
	AND TT.TOutput   = OP.idVar;";
 */
 
 

?>

<!DOCTYPE html>

<html lang="en">

<head>
<!--load the plotly function library-->
<script src="plotly-latest.min.js"></script>



<title>Trail</title>
<!--the css style file in the same path-->
<link type="text/css" rel="stylesheet" href="stylesheet.css">
</head>
<hr/>
<body>
<div id="container">
<div id="header">
	<img style="display: inline;" src="MTS.PNG" alt="logo" />
	<h1>Dyno testing Tool</h1>
<!--the topstatus div-->
<div id="topstatus">
<ul>
<!--load the jquery library-->
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">

<!--auto refresh function-->
$(document).ready(function(){
	$('#topstatus').load('load.php');
	refresh();
});
function refresh()
{
	setTimeout(function(){
		$('#topstatus').load('load.php');
		refresh();
	}, 500);
}
</script>
</ul>
</div>


  
<!--graphic div-->
 <div class="Graphic">
 <div id="myDiv" style="width: 480px; height: 400px;"> </div>
     <h2>Graphic area</h2>
	 <script>
  <!--plot function-->
  function makeplot() {
    Plotly.d3.csv("/uploads/plot/test.csv", function(data){ processData(data) } );

};

function processData(allRows) {

    console.log(allRows);
    var x = [], y = [], standard_deviation = [];

    for (var i=0; i<allRows.length; i++) {
        row = allRows[i];
        x.push( row['AAPL_x'] );
        y.push( row['AAPL_y'] );
    }
    console.log( 'X',x, 'Y',y, 'SD',standard_deviation );
    makePlotly( x, y, standard_deviation );
}

function makePlotly( x, y, standard_deviation ){
    var plotDiv = document.getElementById("plot");
    var traces = [{
        x: x, 
        y: y
    }];

    Plotly.newPlot('myDiv', traces, 
        {title: 'Plotting CSV data from Dyno'});
};
  makeplot();
 
  </script>

  
<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#testtype").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
       var type_id = $(this).val();   /* GET THE VALUE OF THE SELECTED DATA */

      $.ajax({ /* THEN THE AJAX CALL */
        method: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "get_type.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data:{type_id:type_id}, /* THE DATA WE WILL BE PASSING */
        success: function(data){ /* GET THE TO BE RETURNED DATA */
          $("#show_info").html(data); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#testconfig").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
       var config_id = $(this).val();   /* GET THE VALUE OF THE SELECTED DATA */

      $.ajax({ /* THEN THE AJAX CALL */
        method: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "get_config.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data:{config_id:config_id}, /* THE DATA WE WILL BE PASSING */
        success: function(data){ /* GET THE TO BE RETURNED DATA */
          $("#show_info").html(data); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
  
</script>
<script type="text/javascript">
/*$(document).ready(function(){ 
$('#testconfig' ).change(function() {
   var testconfigid = $(this).val() ;    // get the selected value from dropdown
   $('#testconfig' ).html(testconfigid);
   alert(testconfigid);
});             
});   */             
</script>
 </div>
 <div id="existingconfig" class="main">
 <h3>Choose Existing Configuration</h3>
 <?php
 //query TestConfig

$sql = "SELECT * FROM testconfig ORDER BY idtestconfig";
$result = $db->query($sql);
	echo "<label>Configuration: </label>";
    echo "<select id='testconfig' name='testconfig'>";
	echo"<option value=''>Select Configuration</option>";
    while ($row = $result->fetch_assoc()) {
                  unset($id1, $name1);
                  $id1 = $row['idtestconfig'];
                  $name1 = $row['CfgName']; 
                  echo '<option value="'.$id1.'">'.$name1.'</option>';  
				
}
    echo "</select><br/>";

	
?>
</div>

<div id="New" class="main">
<h3>Create New profile</h3>
<?php

//query testType

$sql = "SELECT * FROM testtype ORDER BY idTType";
$result = $db->query($sql);
	echo "<label>TestType: </label>";
    echo "<select id='testtype' name='testtype'>";
	echo"<option value=''>Select Type</option>";
    while ($row = $result->fetch_assoc()) {
		
                  unset($id1, $name1);
                  $id1 = $row['idTType'];
                  $name1 = $row['TName']; 
                  echo '<option value="'.$id1.'">'.$name1.'</option>';  
				
}
    echo "</select><br/><br/>";

	
	
//query Vehiclemodle
$sql = "SELECT * FROM modelinfo ORDER BY idModel";
$result = $db->query($sql);

	echo "<label> Vehiclemodle: </label>";
    echo "<select id='vehiclemodle' name='vehiclemodle'>";
	echo"<option value=''>Select Model</option>";
    while ($row = $result->fetch_assoc()) {
		
                  unset($id2, $name2);
                  $id2 = $row['idModel'];
                  $name2 = $row['ModelName']; 
                  echo '<option value="'.$id2.'">'.$name2.'</option>';            
}
echo "</select><br/><br/>";

//query series

$sql = "SELECT * FROM controlseries ORDER BY idSeries";
$result = $db->query($sql);

	echo "<label> Series: </label>";
    echo "<select id='series' name='series'>";
	echo"<option value=''>Select series</option>";
    while ($row = $result->fetch_assoc()) {
		
                  unset($id3, $name3);
                  $id3 = $row['idSeries'];
                  $name3 = $row['SeriesName']; 
                  echo '<option value="'.$id3.'">'.$name3.'</option>';            
}
echo "</select><br/><br/>";	

?>


</div>

<div id="outer" class="main">

	<div id="show_info" style="display: inline-block;">
	

	</div>

	<div id="input" style="display: inline-block;">
<!--	
		<form name='config1' method='post' action="insert.php";>
			<input name='TestName' style="float: right;" type='text' value="";/><br/><br/>
	
			<input name='min' style="float: right;" type='text'/><br/><br/>

			<input name='max' style="float: right;" type='text'/><br/><br/><br/>
			
			<input type='submit'  name='submit-testconfig' value='insert'>

		</form>
	</div>
-->
	<div id="submit" >
	

	
	</div>



</div>




</body>
</html>

