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

$new = $_GET['new'];
$mmsi = $_GET['mmsi'];
$call = $_GET['call'];
$type = $_GET['type'];



if (empty($mmsi))
{
	                        echo "No MMSI entered";
				                                        echo"<center><br><a href='./index.html'>Index</a></body>";
				                                                exit();
}

if (empty($new))
{
	                        echo "No Ship Name entered";
				                                        echo"<center><br><a href='./index.html'>Index</a></body>";
				                                                exit();
}


if (empty($call))
{
	                        echo "No Callsign entered";
				                                        echo"<center><br><a href='./index.html'>Index</a></body>";
				                                                exit();
}

if (empty($type))
{
	                        echo "No Vessel Type entered";
				                                        echo"<center><br><a href='./index.html'>Index</a></body>";
				                                                exit();
}





$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "update resolve2 set SHIPNAME = '".$new."', CALLSIGN = '".$call."', VESSELTYPE = '".$type."' where MMSI = '".$mmsi."'";


if (mysqli_query($con, $sql)) {
	echo "Success <br>";
}
else
{
	echo "Error: " . $sql . "<br>" . mysqli_error($con);
}


mysqli_close($con);


?>


</center>
<center><br><a href="./index.html">Index</a></body>
</html>

