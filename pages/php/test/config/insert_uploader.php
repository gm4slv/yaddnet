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
<br>


<?php

$rxid = $_GET['RXID'];
$name = $_GET['NAME'];
$location = $_GET['LOCATION'];
$iaru = $_GET['IARU'];
$email = $_GET['EMAIL'];


if (empty($rxid))
{
	                echo "No RXID entered";
			                echo"<center><br><a href='./index.html'>Index</a></body>";
			                        exit();
}

if (empty($name))
{
	                echo "No Name entered";
			                echo"<center><br><a href='./index.html'>Index</a></body>";
			                        exit();
}


if (empty($location))
{
	                echo "No Location entered";
			                echo"<center><br><a href='./index.html'>Index</a></body>";
			                        exit();
}

if (empty($iaru))
{
	                echo "No IARU entered";
			                echo"<center><br><a href='./index.html'>Index</a></body>";
			                        exit();
}

if (empty($email))
{
	                echo "No Email entered";
			                echo"<center><br><a href='./index.html'>Index</a></body>";
			                        exit();
}



$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "insert into uploaders (RXID, NAME, LOCATION, IARU, EMAIL) values ('".$rxid."', '".$name."', '".$location."','".$iaru."','".$email."' )";


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

