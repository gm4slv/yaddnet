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

$old = $_GET['old'];
$rx = $_GET['rx'];
$date_start=$_GET['date_start'];
$date_end=$_GET['date_end'];

if (empty($old))
{
	        echo "No OLD entered";
		echo"<center><br><a href='./config.html'>Index</a></body>";
		        exit();
}


if (empty($rx))

{       echo "No RX_ID entered";
echo"<center><br><a href='./config.html'>Index</a></body>";
        exit();
}


if (empty($date_start))
{
	        echo "No Start Date/time entered";
		echo"<center><br><a href='./config.html'>Index</a></body>";
		        exit();
}

if (empty($date_end))
{
	        echo "No End Date/time entered";
		echo"<center><br><a href='./config.html'>Index</a></body>";
		        exit();
}




$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "delete from newlog where RX_FREQ = '".$old."' and RX_ID = '".$rx."' and datetime > '".$date_start."' and datetime < '".$date_end."' ";


if (mysqli_query($con, $sql)) {
	echo "Success";
}
else
{
	echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>


</center>
<center><br><a href="./config.html">Index</a></body>
</html>

