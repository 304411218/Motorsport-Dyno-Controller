<?php 
// connect to other file
require 'db/connect.php';
require 'db/security.php';

?>

<!DOCUTYPE html>
<html>

<head>
<title>Auto-Refresh DIV</title>
</head>
<body>
<div id="topstatus">

<ul>
		<li>Speed
		<?php 
$sql = "SELECT Status_id,Speed_read FROM Status_Bar ORDER BY Status_id DESC LIMIT 1;";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "" . $row["Speed_read"]. "";
    }
} else {
    echo "N/A";
}
?>
		</li>

		<li>Torque
		<?php 
$sql = "SELECT Status_id,Torque_read FROM Status_Bar ORDER BY Status_id DESC LIMIT 1;";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "" . $row["Torque_read"]. "";
    }
} else {
    echo "N/A";
}
?>
		</li>
		<li>Throttle
		<?php 
$sql = "SELECT Status_id,Throttle_read FROM Status_Bar ORDER BY Status_id DESC LIMIT 1;";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "" . $row["Throttle_read"]. "";
    }
} else {
    echo "N/A";
}
?>
		</li>
		<li>Temp
		<?php 
$sql = "SELECT Status_id,Temp_read FROM Status_Bar ORDER BY Status_id DESC LIMIT 1;";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "" . $row["Temp_read"]. "";
    }
} else {
    echo "N/A";
}
?>
		</li>
	</ul>
</div>
</body>
</html>