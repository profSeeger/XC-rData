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
$arrayPosition = 1;


for ($startingWeek  = 35; $startingWeek < 45; $startingWeek++) {
	for ($startingDay  = 1; $startingDay  <= 7; $startingDay++) {
		$sql = "SELECT *, COUNT(meet) AS meets FROM $table WHERE week = $startingWeek AND day = $startingDay";
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
			    //print $date." ".$meets."<br>";
			     $dailyMeets[$arrayPosition] = $meets;
		    }
		}else{
			$dailyMeets[$arrayPosition] = 0;
		}
		//print $arrayPosition.". ".$startingWeek." ".$startingDay." - ".$dailyMeets[$arrayPosition]."<br>";
		$arrayPosition++;
	}
};



//count the status

$dailyMeetsCancelled=array();
$arrayPosition = 1;
for ($startingWeek  = 35; $startingWeek < 45; $startingWeek++) {
	for ($startingDay  = 1; $startingDay  <= 7; $startingDay++) {
		$sql = "SELECT *, COUNT(meet) AS meets FROM $table WHERE week = $startingWeek AND day = $startingDay AND status = 'cancelled' ";
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
			    //print $date." ".$meets."<br>";
			     $dailyMeetsCancelled[$arrayPosition] = $meets;
		    }
		}else{
			$dailyMeetsCancelled[$arrayPosition] = 0;
		}
		//print $arrayPosition.". ".$startingWeek." ".$startingDay." - ".$dailyMeetsCancelled[$arrayPosition]."<br>";
		$arrayPosition++;
	}
};














//count($dailyMeets)

//print $dailyMeets[8];
$table = "";
$v=0;

for ($j  = 1; $j < 11; $j++) {
	$table .= "<tr height='70px'>";
	for ($i  = 1; $i <= 7; $i++) {
		$v++;
		$p = round((($dailyMeets[$v]-$dailyMeetsCancelled[$v])/$dailyMeets[$v])*100)."%";
		if ($p == "0%") {
			$p = "&nbsp;";
		}
		$table .= "<td>".$p."</td>";
	}
	$table .= "</tr>";
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
	width: 490px;
	font-size: xx-small;
	font-family: sans-serif;
	border-color: #000;
	border-style: solid;
	border-width: 0px;
	padding: 0px;
	border-collapse: collapse;
}



td {
  border: 1px solid #000;
  text-align: center;
  box-sizing: border-box;
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
		<th width=70px; >Monday</th>
		<th width=70px; >Tuesday</th>
		<th width=70px; >Wednesday</th>
		<th width=70px; >Thursday</th>
		<th width=70px; >Friday</th>
		<th width=70px; >Saturday</th>
		<th width=70px; >Sunday</th>
	</tr>
	<?php print $table; ?>

</table>


</body>
</html>