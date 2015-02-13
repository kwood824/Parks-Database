<?php

ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","woodky-db","nHMDCOsl9r8VOesA","woodky-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<body>
<!--Parks Table-->	
		<div>
			<table>
				<tr>
					<td><h2>National Parks</h2></td>
				</tr>
				<tr>
					<td><h3>Name</h3></td>
					<td><h3>Size (Acres)</h3></td>
					<td><h3>Location (State)</h3></td>
				</tr>

<?php
	if(!($stmt = $mysqli->prepare("SELECT parks.name, parks.parksize, parks.location FROM parks"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($name, $parksize, $location)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
	 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $parksize . "\n</td>\n<td>\n" . $location . "\n</td>\n</tr>";
	}
	$stmt->close();
?>

			</table>
		</div>
		
<!--Parks Insertion-->	

		<h1>Insert New Parks</h1>
		
		<div>
			<form method="post" action="addpark.php"> 

				<fieldset>
					<legend>Park Name</legend>
					Name: <input type="text" name="Name" /></p>
				</fieldset>

				<fieldset>
					<legend>Park Size (in acres)</legend>
					<p>Size: <input type="text" name="Size" /></p>
				</fieldset>
				
				<fieldset>
					<legend>Park Location (state)</legend>
					<p>Location: <input type="text" name="Location" /></p>
				</fieldset>

				<p><input type="submit" /></p>
			</form>
		</div>
		
<!--Trails Table-->	
		
		<div>
			<table>
				<tr>
					<td><h2>Park Trails</h2></td>
				</tr>
				<tr>
					<td><h3>Name</h3></td>
					<td><h3>Length (Miles)</h3></td>
					<td><h3>Elevation Change (Feet)</h3></td>
					<td><h3>Difficulty</h3></td>
					<td><h3>Days to Complete</h3></td>
					<td><h3>National Park</h3></td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT trails.name, trails.traillength, trails.elevation, trails.difficulty, trails.days, parks.name FROM trails INNER JOIN parks ON trails.park = parks.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $traillength, $elevation, $difficulty, $days, $park)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $traillength . "\n</td>\n<td>\n" . $elevation . "\n</td>\n<td>\n" . $difficulty . "\n</td>\n<td>\n" . $days . "\n</td>\n<td>\n" . $park . "\n</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		
<!--Trails Insertion-->	

		<h1>Insert New Trails</h1>
		
		<div>
			<form method="post" action="addtrail.php"> 

				<fieldset>
					<legend>Trail Name</legend>
					<p>Name: <input type="text" name="Name" /></p>
				</fieldset>

				<fieldset>
					<legend>Trail Length (in miles)</legend>
					<p>Length: <input type="text" name="Length" /></p>
				</fieldset>
				
				<fieldset>
					<legend>Elevation Change (in feet)</legend>
					<p>Elevation: <input type="text" name="Elevation" /></p>
				</fieldset>
				
				<fieldset>
					<legend>Trail Difficulty</legend>
					<select name="Difficulty">
						<option>Easy</option>
						<option>Moderate</option>
						<option>Strenuous</option>
					</select>
				</fieldset>
				
				<fieldset>
					<legend>Days to Complete</legend>
					<p>Days: <input type="text" name="Days" /></p>
				</fieldset>

				<fieldset>
					<legend>National Park</legend>
					<select name="Park">
						
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM parks"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $pname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
}
$stmt->close();
?>
					</select>
				</fieldset>
				<p><input type="submit" /></p>
			</form>
		</div>
		
<!--Wildlife Table-->		

		<div>
			<table>
				<tr>
					<td><h2>Park Wildlife</h2></td>
				</tr>
				<tr>
					<td><h3>Name</h3></td>
					<td><h3>Class</h3></td>
					<td><h3>Rarity</h3></td>
					<td><h3>Biome</h3></td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT wildlife.name, wildlife.classification, wildlife.rarity, natural_features.biome_name FROM wildlife INNER JOIN natural_features ON wildlife.biome = natural_features.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $classification, $rarity, $biome)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $classification . "\n</td>\n<td>\n" . $rarity . "\n</td>\n<td>\n" . $biome . "\n</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		
		
<!--Wildlife Insertion-->

		<h1>Insert New Wildlife</h1>

		<div>
			<form method="post" action="addwildlife.php"> 

				<fieldset>
					<legend>Wildlife Name</legend>
					<p>Name: <input type="text" name="Name" /></p>
				</fieldset>

				<fieldset>
					<legend>Wildlife Class</legend>
					<select name="Class">
						<option>Mammal</option>
						<option>Bird</option>
						<option>Fish</option>
						<option>Reptile</option>
						<option>Amphibian</option>
						<option>Plant</option>
						<option>Fungus</option>
					</select>
				</fieldset>
				
				<fieldset>
					<legend>Rarity</legend>
					<select name="Rarity">
						<option>Rare</option>
						<option>Common</option>
						<option>Abundant</option>
					</select>
				</fieldset>

				<fieldset>
					<legend>Biome</legend>
					<select name="Biome">
						
<?php
if(!($stmt = $mysqli->prepare("SELECT id, biome_name FROM natural_features"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
					</select>
				</fieldset>
				<p><input type="submit" /></p>
			</form>
		</div>
		
<!--Natural Features Table-->
		
		<div>
			<table>
				<tr>
					<td><h2>Natural Features</h2></td>
				</tr>
				<tr>
					<td><h3>Biome Name</h3></td>
					<td><h3>Type of Weather</h3></td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT natural_features.biome_name, natural_features.weather FROM natural_features"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name, $weather)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $weather . "\n</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		
<!--Natural Features Insertion-->

		<h1>Insert New Natural Features</h1>
		
		<div>
			<form method="post" action="addfeatures.php"> 

				<fieldset>
					<legend>Biome Name</legend>
					<p>Name: <input type="text" name="Name" /></p>
				</fieldset>
				
				<fieldset>
					<legend>Type of Weather</legend>
					<p>Weather: <input type="text" name="Weather" /></p>
				</fieldset>

				<p><input type="submit" /></p>
			</form>
		</div>
		
<!--Wildlife_Parks Insertion-->

		<h1>Pair Wildlife to Parks</h1>
		
		<div>
			<form method="post" action="addwildlife_parks.php">
				<fieldset>
					<legend>Select a National Park</legend>
						<select name="Park">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM parks"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $name)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
				</fieldset>
				
				<fieldset>
					<legend>Select Wildlife that Goes with that Park</legend>
						<select name="Wildlife">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM wildlife"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $name)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
				</fieldset>
				<p><input type="submit" /></p>
			</form>
		</div>
		
<!--Parks_features Insertion-->
		
		<h1>Pair Natural Features to Parks</h1>
		
		<div>
			<form method="post" action="addfeatures_parks.php">
				<fieldset>
					<legend>Select a National Park</legend>
						<select name="Park">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM parks"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $name)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
				</fieldset>
				
				<fieldset>
					<legend>Select a Biome that Goes with that Park</legend>
						<select name="Biome">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, biome_name FROM natural_features"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $name)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
				</fieldset>
				<p><input type="submit" /></p>
			</form>
		</div>
		
<!--Filter Features by Park-->

		<h1>Find out what Trails, Wildlife and Biomes are at each Park!</h1>
		
		<div>
			<form method="post" action="filter.php">
				<fieldset>
					<legend>Select a National Park</legend>
						<select name="Park">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM parks"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id, $name)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();
							?>
						</select>
					</fieldset>
					<p><input type="submit" /></p>
				</form>
			</div>
		
	</body>
</html>