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
<h2> YaDDNet : MF/HF DSC Database</h2>

<h3>This view is of</h3>
<b>System Log</b>: IP addresses vs. RX_ID
<br>
<br>


<?php

$one = $_GET['one'];
$two = $_GET['two'];
$three = $_GET['three'];

if (empty($one))
{
	$one = "HAMSTER";
}

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$sql = "insert into test (ONE, TWO, THREE) values ( '".$one."', '".$two."', '".$three."')";


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
<center><br><a href="./read_test.php">READ</a></body>
<center><br><a href="./insert_index.php">Index</a></body>
</html>

