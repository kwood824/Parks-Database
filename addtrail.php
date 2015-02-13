<?php

ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","woodky-db","nHMDCOsl9r8VOesA","woodky-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
if(!($stmt = $mysqli->prepare("INSERT INTO trails(name, traillength, elevation, difficulty, days, park) VALUES (?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("siisii",$_POST['Name'],$_POST['Length'],$_POST['Elevation'],$_POST['Difficulty'],$_POST['Days'],$_POST['Park']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to trails.";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<body>
		<a href="database_final.php">Return to Database</a>
	</body>
</html>