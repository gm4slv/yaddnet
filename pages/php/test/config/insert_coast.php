<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <title>
Logger
    </title>
  </head>
  <body bgcolor="c8d5e6">
	<basefont face="Ariel">

<center>


<?php

$mmsi = $_GET['mmsi'];
$coastname = $_GET['coastname'];
$mid = $_GET['mid'];
$ccc = $_GET['ccc'];
$ctry = $_GET['ctry'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$special = $_GET['special'];

echo "special : ";
echo $special;
echo "<br>";

if (empty($mmsi))
{
	        echo "No MMSI entered";
		echo"<center><br><a href='./index.html'>Index</a></body>";
		        exit();
}

if (empty($coastname))
{
	        echo "No Coastname entered";
		echo"<center><br><a href='./index.html'>Index</a></body>";
		        exit();
}


if (empty($mid))
{
	        echo "No MID entered";
		echo"<center><br><a href='./index.html'>Index</a></body>";
		        exit();
}

if (empty($ccc))
{
	        echo "No CCC entered";
		echo"<center><br><a href='./index.html'>Index</a></body>";
		        exit();
}

if (empty($ctry))

{       echo "No CTRY entered";
echo"<center><br><a href='./index.html'>Index</a></body>";
        exit();
}



if (empty($lat))
{
	$lat = "0";
}
if (empty($lon))
{
	$lon = "0";
}


$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "insert into coast (MMSI, COASTNAME, MID, CCC, CTRY, LAT, LON) values ( '".$mmsi."', '".$coastname."', '".$mid."', '".$ccc."', '".$ctry."', '".$lat."', '".$lon."')";
$sql1 = "insert into special (MMSI, COASTNAME) values ( '".$mmsi."', '".$coastname."')";
$sql2 = "update newlog set to_type = 'COAST', to_name = '".$coastname."' where raw_to_mmsi = '".$mmsi."' ";
$sql3 = "update newlog set from_type = 'COAST', from_name = '".$coastname."' where raw_from_mmsi = '".$mmsi."' ";

if (mysqli_query($con, $sql)) {
	echo "Success : New Coast Record added<br>";
}
else
{
	echo "Error: " . $sql . "<br>" . mysqli_error($con);
}



if (mysqli_query($con, $sql2)) {
	echo "Success : Old To: entries updated<br>";
}
else
{
	echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
}

if (mysqli_query($con, $sql3)) {
	echo "Success : Old From: entries updated<br>";
}
else
{
	echo "Error: " . $sql3 . "<br>" . mysqli_error($con);
}



if ($special == "True"){ 
	
	
	if (mysqli_query($con, $sql1)) {
		echo "Success : Special Added<br>";
	}
	else
	{
		echo "Error: " . $sql1 . "<br>" . mysqli_error($con);
	}


}

mysqli_close($con);
?>


</center>
<center><br><a href="./index.html">Index</a></body>
</html>

