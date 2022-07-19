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

$mid = $_GET['mid'];
$ccc = $_GET['ccc'];
$ctry = $_GET['ctry'];

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

{	echo "No CTRY entered";
echo"<center><br><a href='./index.html'>Index</a></body>";
	exit();
}

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "insert into mid ( MID, CCC, CTRY) values (  '".$mid."', '".$ccc."', '".$ctry."')";


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
<center><br><a href="./index.html">Index</a></body>
</html>

