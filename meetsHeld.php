<?php


//header('Content-type: text/plain');
require("../../conn1.php");

$mysqli = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$table = 'XC_meetDates';





$a=array();



$sql = "SELECT * FROM $table ORDER BY date DESC";

$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	    $name = $row["year"];
	    $date = $row["date"];
	    $x = $row["status"];
	     //print $name."<br>";
	     //print $date."<br>";
	     array_push($a, $x);
    }

//print_r($a);
print $a[3];
}

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