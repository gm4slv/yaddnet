 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Report</title>
    <meta http-equiv="Content-Type" content="text/html" />
</head>
 <body bgcolor="c8d5e6">
	<basefont face="Arial">
<center>

<?php

$reporter=$_GET['reporter'];

$rx=$_GET['rxid'];

$unid=$_GET['unid'];

$p=$_GET['p'];

if ($p<"8")
{
$pp=$p-1;
}
else
{
$pp=0;
}
//$showrx="yes";
$showrx=$_GET['showrx'];
//$eccc=$_GET['eccc'];
$eccc="ok";

// Frequency ONE ///////////////////////////////

$rx_freq="2187.5";

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$fd=exec("date +%Y-%m-%d-%H%M%S");

$file='./tmp/' . $fd . '.txt';

$f = fopen($file, 'w');




$result = mysqli_query($con,"select DATE_FORMAT(DATETIME, '%H%i'), DATE_FORMAT(DATETIME, '%d%b%y'), RX_FREQ, RX_ID, MIN(RAW_FROM_MMSI), FROM_NAME, FROM_CTRY, RAW_TO_MMSI, TO_NAME, ECC from newlog where (datetime>date_sub(curdate(), interval $p day) and datetime<date_sub(curdate(), interval $pp day)) and rx_freq like '%".$rx_freq."%' and FROM_TYPE='SHIP' and RAW_FROM_MMSI not like '%~%' and FROM_NAME not like '%".$unid."%' and ECC like '%".$eccc."%' and RX_ID like '%".$rx."%'  group by RAW_FROM_MMSI order by RAW_FROM_MMSI"); 


while ($row=mysqli_fetch_array($result)) {

$date = $row['DATE_FORMAT(DATETIME, \'%d%b%y\')'];
$time = $row['DATE_FORMAT(DATETIME, \'%H%i\')'];
$rx_freq = sprintf('%07.1f',$row['RX_FREQ']);
$rx_id = $row['RX_ID'];
//$rx_id="[YaDDNet]";
$from_mmsi = $row['MIN(RAW_FROM_MMSI)'];
$from_name = $row['FROM_NAME'];
$ctry = $row['FROM_CTRY'];
#$ccc = $row['FROM_CCC'];
$ecc = $row['ECC'];
$to_mmsi = $row['RAW_TO_MMSI'];
$to_name = $row['TO_NAME'];
	
if ($showrx=="yes")
{
	$output = "$datetime $rx_freq $from_mmsi $from_name, $ctry\t\t\t$rx_id\n";
}
else
{

	$output = "$rx_freq  $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
	//$output = "$rx_freq $from_mmsi: $from_name, $ctry clg $to_mmsi $to_name $time DSC/100/170 ($date) ($reporter) \n";
}	

fwrite($f, $output);
}

mysqli_close($con);

////////////////////////////////////

// Frequency TWO ///////////////////////////////

$rx_freq="4207.5";

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }






$result = mysqli_query($con,"select DATE_FORMAT(DATETIME, '%H%i'), DATE_FORMAT(DATETIME, '%d%b%y'), RX_FREQ, RX_ID, MIN(RAW_FROM_MMSI), FROM_NAME, FROM_CTRY, RAW_TO_MMSI, TO_NAME, ECC from newlog where (datetime>date_sub(curdate(), interval $p day) and datetime<date_sub(curdate(), interval $pp day)) and rx_freq like '%".$rx_freq."%' and FROM_TYPE='SHIP' and RAW_FROM_MMSI not like '%~%' and FROM_NAME not like '%".$unid."%' and ECC like '%".$eccc."%' and RX_ID like '%".$rx."%'  group by RAW_FROM_MMSI order by RAW_FROM_MMSI"); 


while ($row=mysqli_fetch_array($result)) {

$date = $row['DATE_FORMAT(DATETIME, \'%d%b%y\')'];
$time = $row['DATE_FORMAT(DATETIME, \'%H%i\')'];
$rx_freq = sprintf('%07.1f',$row['RX_FREQ']);
$rx_id = $row['RX_ID'];
//$rx_id="[YaDDNet]";
$from_mmsi = $row['MIN(RAW_FROM_MMSI)'];
$from_name = $row['FROM_NAME'];
$ctry = $row['FROM_CTRY'];
#$ccc = $row['FROM_CCC'];
$ecc = $row['ECC'];
$to_mmsi = $row['RAW_TO_MMSI'];
$to_name = $row['TO_NAME'];
	
if ($showrx=="yes")
{
	$output = "$datetime $rx_freq $from_mmsi $from_name, $ctry\t\t\t$rx_id\n";
}
else
{
	$output = "$rx_freq  $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
	//$output = "$rx_freq $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry clg $to_mmsi $to_name $time DSC/100/170 ($date) ($reporter) \n";
}	

fwrite($f, $output);
}

mysqli_close($con);

// Frequency THREE //////////////////////////////

$rx_freq="6312.0";

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select DATE_FORMAT(DATETIME, '%H%i'), DATE_FORMAT(DATETIME, '%d%b%y'), RX_FREQ, RX_ID, MIN(RAW_FROM_MMSI), FROM_NAME, FROM_CTRY, RAW_TO_MMSI, TO_NAME, ECC from newlog where (datetime>date_sub(curdate(), interval $p day) and datetime<date_sub(curdate(), interval $pp day)) and rx_freq like '%".$rx_freq."%' and FROM_TYPE='SHIP' and RAW_FROM_MMSI not like '%~%' and FROM_NAME not like '%".$unid."%' and ECC like '%".$eccc."%' and RX_ID like '%".$rx."%'  group by RAW_FROM_MMSI order by RAW_FROM_MMSI"); 


while ($row=mysqli_fetch_array($result)) {

$date = $row['DATE_FORMAT(DATETIME, \'%d%b%y\')'];
$time = $row['DATE_FORMAT(DATETIME, \'%H%i\')'];
$rx_freq = sprintf('%07.1f',$row['RX_FREQ']);
$rx_id = $row['RX_ID'];
//$rx_id="[YaDDNet]";
$from_mmsi = $row['MIN(RAW_FROM_MMSI)'];
$from_name = $row['FROM_NAME'];
$ctry = $row['FROM_CTRY'];
#$ccc = $row['FROM_CCC'];
$ecc = $row['ECC'];
$to_mmsi = $row['RAW_TO_MMSI'];
$to_name = $row['TO_NAME'];
	
if ($showrx=="yes")
{
	$output = "$datetime $rx_freq $from_mmsi $from_name, $ctry\t\t\t$rx_id\n";
}
else
{
	$output = "$rx_freq  $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
	//$output = "$rx_freq $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry clg $to_mmsi $to_name $time DSC/100/170 ($date) ($reporter) \n";
}	

fwrite($f, $output);
}

mysqli_close($con);

// Frequency FOUR //////////////////////////////

$rx_freq="8414.5";

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select DATE_FORMAT(DATETIME, '%H%i'), DATE_FORMAT(DATETIME, '%d%b%y'), RX_FREQ, RX_ID, MIN(RAW_FROM_MMSI), FROM_NAME, FROM_CTRY, RAW_TO_MMSI, TO_NAME, ECC from newlog where (datetime>date_sub(curdate(), interval $p day) and datetime<date_sub(curdate(), interval $pp day)) and rx_freq like '%".$rx_freq."%' and FROM_TYPE='SHIP' and RAW_FROM_MMSI not like '%~%' and FROM_NAME not like '%".$unid."%' and ECC like '%".$eccc."%' and RX_ID like '%".$rx."%'  group by RAW_FROM_MMSI order by RAW_FROM_MMSI"); 


while ($row=mysqli_fetch_array($result)) {

$date = $row['DATE_FORMAT(DATETIME, \'%d%b%y\')'];
$time = $row['DATE_FORMAT(DATETIME, \'%H%i\')'];
$rx_freq = sprintf('%07.1f',$row['RX_FREQ']);
$rx_id = $row['RX_ID'];
//$rx_id="[YaDDNet]";
$from_mmsi = $row['MIN(RAW_FROM_MMSI)'];
$from_name = $row['FROM_NAME'];
$ctry = $row['FROM_CTRY'];
#$ccc = $row['FROM_CCC'];
$ecc = $row['ECC'];
$to_mmsi = $row['RAW_TO_MMSI'];
$to_name = $row['TO_NAME'];
	
if ($showrx=="yes")
{
	$output = "$datetime $rx_freq $from_mmsi $from_name, $ctry\t\t\t$rx_id\n";
}
else
{
	$output = "$rx_freq  $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry clg $to_mmsi $to_name $time DSC/100/170 ($date) ($reporter) \n";
}	

fwrite($f, $output);
}

mysqli_close($con);

// Frequency FIVE //////////////////////////////

$rx_freq="12577.0";

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select DATE_FORMAT(DATETIME, '%H%i'), DATE_FORMAT(DATETIME, '%d%b%y'), RX_FREQ, RX_ID, MIN(RAW_FROM_MMSI), FROM_NAME, FROM_CTRY, RAW_TO_MMSI, TO_NAME, ECC from newlog where (datetime>date_sub(curdate(), interval $p day) and datetime<date_sub(curdate(), interval $pp day)) and rx_freq like '%".$rx_freq."%' and FROM_TYPE='SHIP' and RAW_FROM_MMSI not like '%~%' and FROM_NAME not like '%".$unid."%' and ECC like '%".$eccc."%' and RX_ID like '%".$rx."%'  group by RAW_FROM_MMSI order by RAW_FROM_MMSI"); 


while ($row=mysqli_fetch_array($result)) {

$date = $row['DATE_FORMAT(DATETIME, \'%d%b%y\')'];
$time = $row['DATE_FORMAT(DATETIME, \'%H%i\')'];
$rx_freq = sprintf('%07.1f',$row['RX_FREQ']);
$rx_id = $row['RX_ID'];
//$rx_id="[YaDDNet]";
$from_mmsi = $row['MIN(RAW_FROM_MMSI)'];
$from_name = $row['FROM_NAME'];
$ctry = $row['FROM_CTRY'];
#$ccc = $row['FROM_CCC'];
$ecc = $row['ECC'];
$to_mmsi = $row['RAW_TO_MMSI'];
$to_name = $row['TO_NAME'];
	
if ($showrx=="yes")
{
	$output = "$datetime $rx_freq $from_mmsi $from_name, $ctry\t\t\t$rx_id\n";
}
else
{
	$output = "$rx_freq  $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry clg $to_mmsi $to_name $time DSC/100/170 ($date) ($reporter) \n";
}	

fwrite($f, $output);
}

mysqli_close($con);

// Frequency SIX //////////////////////////////

$rx_freq="16804.5";

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select DATE_FORMAT(DATETIME, '%H%i'), DATE_FORMAT(DATETIME, '%d%b%y'), RX_FREQ, RX_ID, MIN(RAW_FROM_MMSI), FROM_NAME, FROM_CTRY, RAW_TO_MMSI, TO_NAME, ECC from newlog where (datetime>date_sub(curdate(), interval $p day) and datetime<date_sub(curdate(), interval $pp day)) and rx_freq like '%".$rx_freq."%' and FROM_TYPE='SHIP' and RAW_FROM_MMSI not like '%~%' and FROM_NAME not like '%".$unid."%' and ECC like '%".$eccc."%' and RX_ID like '%".$rx."%'  group by RAW_FROM_MMSI order by RAW_FROM_MMSI"); 


while ($row=mysqli_fetch_array($result)) {

$date = $row['DATE_FORMAT(DATETIME, \'%d%b%y\')'];
$time = $row['DATE_FORMAT(DATETIME, \'%H%i\')'];
$rx_freq = sprintf('%07.1f',$row['RX_FREQ']);
$rx_id = $row['RX_ID'];
//$rx_id="[YaDDNet]";
$from_mmsi = $row['MIN(RAW_FROM_MMSI)'];
$from_name = $row['FROM_NAME'];
$ctry = $row['FROM_CTRY'];
#$ccc = $row['FROM_CCC'];
$ecc = $row['ECC'];
$to_mmsi = $row['RAW_TO_MMSI'];
$to_name = $row['TO_NAME'];
	
if ($showrx=="yes")
{
	$output = "$datetime $rx_freq $from_mmsi $from_name, $ctry\t\t\t$rx_id\n";
}
else
{
	$output = "$rx_freq  $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry $time clg $to_mmsi $to_name DSC/100/170 ($date) ($reporter) \n";
//	$output = "$rx_freq $from_mmsi: $from_name, $ctry clg $to_mmsi $to_name $time DSC/100/170 ($date) ($reporter) \n";
}	

fwrite($f, $output);
}










fclose($f);

mysqli_close($con);


// Remove "COAST" from each record

echo "<br><br>";
//echo "Receivers used : " . $rx1 . " " . $rx2 . " " .$rx3. " " .$rx4. "<br><br>";
echo "Click to read or 'Right Click' to Save As...<a href=".$file.">File output</a>  :<br>";
echo "<br>Preview....<br>";
echo "<iframe width=60% height=800 src=".$file."></iframe>";

//mysqli_close($con);
?>
<br><br><br>
<a href="../../../index.php">HOME</a>
</center>
</body>
</html>
 
