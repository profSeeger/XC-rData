<?php


//header('Content-type: text/plain');
require("../../conn1.php");

$mysqli = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$table = 'XC_meetDates';





$dailyMeets=array();


$arrayPosition = 0;


for ($startingWeek  = 41; $startingWeek < 42; $startingWeek++) {
	for ($startingDay  = 1; $startingDay  <= 7; $startingDay++) {
		$sql = "SELECT *, COUNT(meet) AS meets FROM $table GROUP BY date WHERE week = $startingWeek AND day = $startingDay";
		//print $sql."<br>";


		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
			    $name = $row["year"];
			    $date = $row["date"];
			    $meets = $row["meets"];
			    $week = $row["week"];
			    $day = $row["day"];
			     //print $name."<br>";
			     print $date." ".$meets."<br>";
			     $dailyMeets[$arrayPosition] = $meets;
		    }
		}else{
			$dailyMeets[$arrayPosition] = 0;
		}
		print $dailyMeets[$arrayPosition]."<br>";
		$arrayPosition++;
	}
};






$mysqli->close();

?>




<!DOCTYPE html>
<html lang="en">
<head>
<title>Meet Dates Visualizer</title>

<style>
html, body {
    /*height:100%;*/
    margin:10 px;
    padding:0;
	height: 100vh;
}

#meetCalGrid{
	width: 500px;
	font-size: small;
	font-family: sans-serif;
	border-color: #000;
	border-style: solid;
	border-width: 0px;
	 padding: 5px;
	  border-collapse: collapse;
}



td {
  border-bottom: 1px solid #000;
  text-align: center;
}

th {
  border-top: 0px solid #ddd;
}



</style>

<script>

</script>
</head>

<body>
<table id='meetCalGrid'>
	<tr>
		<th>Sunday</th>
		<th>Monday</th>
		<th>Tuesday</th>
		<th>Wednesday</th>
		<th>Thursday</th>
		<th>Friday</th>
		<th>Saturday</th>
	</tr>
	<tr>
		<td>10%</td>
		<td>10%</td>
		<td>10%</td>
		<td>10%</td>
		<td>10%</td>
		<td>10%</td>
		<td>10%</td>
	</tr>

</table>


</body>
</html>