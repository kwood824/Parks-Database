<?php

ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","woodky-db","nHMDCOsl9r8VOesA","woodky-db");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
	<div>
		<table>
			<tr>
				<td><h2>Park Features</h2></td>
			</tr>
			<tr>
				<td><h3>Trails</h3></td>
				<td><h3>Wildlife</h3></td>
				<td><h3>Biomes</h3></td>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT trails.name, wildlife.name, natural_features.biome_name FROM parks 
	LEFT JOIN trails ON trails.park = parks.id 
	LEFT JOIN wildlife_parks ON wildlife_parks.NP_id = parks.id
	LEFT JOIN parks_features ON parks_features.NParks_id = parks.id
	LEFT JOIN wildlife ON wildlife.id = wildlife_parks.wild_id
	LEFT JOIN natural_features ON natural_features.id = parks_features.nat_id
	WHERE parks.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Park']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($trails, $wildlife, $features)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $trails . "\n</td>\n<td>\n" . $wildlife . "\n</td>\n<td>\n" . $features . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>
	</div>

	<a href="database_final.php">Return to Database</a>

</body>
</html>