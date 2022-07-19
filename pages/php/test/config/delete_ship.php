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


if (empty($mmsi))
{
	                echo "No MMSI entered";
			                echo"<center><br><a href='./index.html'>Index</a></body>";
			                        exit();
}




$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "delete from resolve2 where MMSI ='".$mmsi."'";


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

