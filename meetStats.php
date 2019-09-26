<?php

//header('Content-type: text/plain');
require("../../conn1.php");


$mysqli = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$table = "crossCountryResults";

/*
$sql = "SELECT * FROM $table WHERE minutes < 1";


$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	    $name = $row["name"];
	    $timeRaw = $row["timeRaw"];
		$pid = $row["pid"];
	    list ($minutes, $sec) = split(":", $timeRaw );


$secondsTotal = ($minutes * 60) + $sec;
$timeDec = $secondsTotal/60;

   // print $name." ".$minutes."-".$sec."=".$secondsTotal."<br>";

	    $sql2 = "UPDATE $table SET minutes='$minutes', sec='$sec', secondsTotal=$secondsTotal, timeDec = $timeDec WHERE pid=$pid";
		$mysqli->query($sql2);

    }
}



*/

//Get Median time of Top 10

$n = 10;



$raceArray = array('V_Girls', 'V_Boys', 'JH_Girls', 'JH_Boys');

$yearArray = array('2015', '2016', '2017', '2018');

$nArray = array(10, 50);


foreach ($raceArray as $race) {
print "<br><strong>$race </strong><br>";

foreach ($yearArray as $year) {

	print "<br><strong>$year </strong><br>";

foreach ($nArray as $n) {



//for ($x = 1; $x < 5; $x++) {

	$totalTime = 0;
	$sql = "SELECT * FROM $table WHERE race = '$race' AND place <= $n AND year = '$year' ORDER By place";
	$result = $mysqli->query($sql);


	//race = 'V_Boys' AND place < 11 ORDER By rid
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
		    $name = $row["name"];
		    $place = $row["place"];
		    $timeDec = $row["timeDec"];
		    $year = $row["year"];

		   $totalTime = $totalTime + $timeDec;
			//print $year." ".$place." ".$name.", ".$timeDec."<br>";
	    }
	}



	//print "Total Time: ".$totalTime."<br>"
	$avgDecimal = $totalTime/$n;
	//print "<br>Average Time (Decimal): ".$avgDecimal."<br>";

	$whole = floor($n);

	$whole = floor($avgDecimal);
	$sec = $avgDecimal - $whole;
	$sec = $sec*60;

	print "Average Top $n: ".$whole.":".$sec."<br>";
}
}
}

$mysqli->close();
?>





<!DOCTYPE html>
<html>
<head>
<meta name="description" content="">
<meta charset="utf-8">
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<style>
html, body {
    /*height:100%;*/
    margin:0;
    padding:0;
	height: 100vh;
}
</style>

<script>

</script>

</head>
<body>


</body>
</html>