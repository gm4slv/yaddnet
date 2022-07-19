<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <title>
Band View</title>
	<meta http-equiv="refresh" content="300">
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
  </head>
  <!--<body bgcolor="c8d5e6">-->
  <body bgcolor="c8d5e6">
	<basefont face="Ariel">

<center>
<h2> YaDDNet : MF/HF DSC Database</h2>

<h3>This view is of</h3>
Today's messages : All connected YaDD monitors<br>
<br>
<br>
</font>
<?php


$timescale = $_GET['timescale'];

echo "Showing last : " . $timescale . " hours<br><br>";

$from_type="%";
$to_type="%";

$coast=$_GET['coast'];
$freq=$_GET['rx_freq'];

if ($freq == "ALL")
{
$fmin = 2000;
$fmax = 30000;
}

else
{
$fmax=($freq * 1000)+2000;
$fmin=($freq * 1000);
}


$eccc=$_GET['ecc'];
$tilde=$_GET['tilde'];

echo "Frequency Range : " . $fmin . "kHz  -> " . $fmax . "kHz<br>";

if ($eccc=="all")
{
$ecc="%";
echo "Showing ECC OK & ERR<br>";
}
else
{
$ecc="OK";
echo "Showing only ECC OK<br>";
}

$ignore=$_GET['ignore'];

if ($ignore=="y")
{
$ignore_string="and rx_freq not like '%2187.5%' and rx_freq not like '%4207.5%' and rx_freq not like '%6312.0%' and rx_freq not like '%8414.5%' and rx_freq not like  '%12577.0%' and rx_freq not like  '%16804.5%'";
echo "Showing only non-GMDSS frequencies<br>";
}
else
{
$ignore_string="";
}

$notest=$_GET['notest'];

if ($notest=="y")
{
$notest_string="and TC1 not like '%TEST%' ";
echo "Not Showing Test Calls<br>";
}
else
{
$notest_string="";
}

$urgdis=$_GET['urgdis'];

if ($urgdis=="y")
{
$urgdis_string="and (cat like '%urg%' or cat like '%dis%') ";
echo "Only Urgency / Distress<br>";
}
else
{
$urgdis_string="";
}


if ($coast=="coast")
{
echo "Coast Stations only<br>";
}

if ($coast=="ship")
{
echo "Ship Stations only<br>";
}

if ($coast=="%")
{
echo "All Stations<br>";
}
 if ($coast=="cc")
 {
 $from_type="coast";
 $to_type="coast";
 }
 if ($coast=="ss")
 {
 $from_type="ship";
 $to_type="ship";
 }
 if ($coast=="coast")
 {
 $from_type="coast";
 $to_type="%";
 }
 if ($coast=="ship")
 {
 $from_type="ship";
 $to_type="%";
 }
 
 if ($tilde=="y")
 { 
 $tilde_string = "and raw_from_mmsi not like '%~%' and raw_to_mmsi not like '%~%' and freq not like '%~%' and pos not like '%~%' and eos not like '%~%' ";
 echo "Ignoring Messages with Incomplete Symbols (parity check failures)";
 } else
 {
 $tilde_string = "";
 }

$fd=exec("date +%Y-%m-%d-%H%M%S");

$file='./test/tmp/' . $fd . '.txt';

$f = fopen($file, 'w');


$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//$result = mysqli_query($con,"SELECT * FROM newlog where datetime > date_sub(utc_timestamp(), interval 24 hour) and FROM_TYPE like '%".$from_type."%' and TO_TYPE like '%".$to_type."%' and RX_FREQ >$fmin and RX_FREQ<$fmax $notest_string $urgdis_string $ignore_string $tilde_string and ECC like '%".$ecc."%' order by datetime desc");

$result = mysqli_query($con,"SELECT * FROM newlog where datetime > date_sub(utc_timestamp(), interval ".$timescale."  hour) and FROM_TYPE like '%".$from_type."%' and TO_TYPE like '%".$to_type."%' and RX_FREQ >$fmin and RX_FREQ<$fmax $notest_string $urgdis_string $ignore_string  order by datetime desc");

echo "<br>";
echo "Text file output for copying into documents/email etc <br>";      
echo "Click to read or 'Right Click' to Save As...<a href=".$file.">File output</a>  :<br><br>";


echo "<table border='0' cellpadding='5' rules='all'>
<tr>
<th> <font face=monospace color=blue size='3pt'>Date  /  UTC</font></th>
<th><font face=monospace color=#424242 size='3pt'>Freq</font></th>
<th><font face=monospace color=black size='3pt'>FMT</font></th>
<th> <font  face=monospace color=black size='3pt'>To</font></th>
<th> <font  face=monospace color=black size='3pt'>CAT</font></th>
<th> <font  face=monospace color=black size='3pt'>From</font></th>
<th> <font  face=monospace color=blue size='3pt'>TC1</font></th>
<th> <font  face=monospace color=blue size='3pt'>TC2</font></th>
<th> <font  face=monospace color=crimson size='3pt'>Freq</font></th>
<th> <font  face=monospace color=crimson size='3pt'>Pos</font></th>
<th> <font  face=monospace color=blue size='3pt'>EOS</font></th>";

//<th> <font  face=monospace color=#424242 size='3pt'>ECC</font></th>
echo "<th><font face=monospace color=#541b66 size='3pt'>RX_ID</font></th>
</tr>";

while($row = mysqli_fetch_array($result))
{

	if ($row['TO_TYPE'] == "SHIP")
		$colorto = "brown";
	else if ($row['TO_TYPE'] == "COAST")
		$colorto = "green";
	else if ($row['TO_TYPE'] == "GROUP")
		$colorto = "blue";
	else
		$colorto = "black";


	if ($row['FROM_TYPE'] == "SHIP")
		$colorfrom = "brown";
	else if ($row['FROM_TYPE'] == "COAST")
		$colorfrom = "green";
	else if ($row['FROM_TYPE'] == "GROUP")
		$colorfrom = "blue";
	else
		$colorfrom = "black";


  echo "<tr>";

  echo "<td width='6%'><font face=monospace color=blue size='3pt'><a href='./search_qso.php?coast_mmsi=" . $row['RAW_TO_MMSI']. "&ship_mmsi=". $row['RAW_FROM_MMSI']."' >" . $row['DATETIME'] . "</a></font> </td>";
//  echo "<td width='6%'><font face=monospace color=blue size='3pt'>"  . $row['DATETIME'] . "</font> </td>";
  echo "<td width='4%'><font  face=monospace color=#424242 size='3pt'>" . $row['RX_FREQ'] . "</font></td>";
  echo "<td align=center width='2%'><font  face=monospace color=black size='3pt'>" . $row['FMT'] . "</font></td>";


  echo "<td  width='22%' nowrap><font face=monospace color=$colorto size='3pt'>" . $row['TO_TYPE'] . "<br></font>";

if ($row['TO_TYPE'] == "AREA")
  echo " <font face=monospace color=$colorto size='3pt'>" . $row['RAW_TO_MMSI'] . "</font><br>";
else


echo " <font face=monospace color=$colorto size='3pt'><a href='./band_today_messages.php?from_mmsi=" . $row['RAW_TO_MMSI'] . "&rx_freq=" . $row['RX_FREQ'] . "' style='color:$colorto' >" . $row['RAW_TO_MMSI'] . "</a></font><br>";
  

//	  echo " <font face=monospace color=$colorto size='3pt'>" . $row['RAW_TO_MMSI'] . " </font><br>";
  
if ($row['TO_TYPE'] == "SHIP")
	  echo "<font face=monospace color=black size='3pt'><a href=\"https://www.myshiptracking.com/vessels/". $row['RAW_TO_MMSI']."\">".$row['TO_NAME']."</a></font><br><font face=monospace color=black size='3pt'>" . $row['TO_CTRY'] . "</font></td>";
	  //echo "<font face=monospace color=black size='3pt'><a href=\"http://www.marinetraffic.com/en/ais/details/ships/mmsi:". $row['RAW_TO_MMSI']."\">".$row['TO_NAME']."</a></font><br><font face=monospace color=black size='3pt'>" . $row['TO_CTRY'] . "</font></td>";
 else if ($row['TO_TYPE'] == "COAST")
	  echo "<font face=monospace color=black size='3pt'>" . $row['TO_NAME'] . "</font><br><font face = monospace color=black size='3pt'>" . $row['TO_CTRY']. "</font></td>";
  else if ($row['TO_TYPE'] == "GROUP")

	 echo "<font  face=monospace color=black size='3pt'>" . $row['TO_NAME'] . "</font><br><font face=monospace color=black size='3pt'>" . $row['TO_CTRY'] . "</font></td>";
else if ($row['TO_TYPE'] == "ALL")
        echo "<font  face=monospace color=black size='3pt'>" . $row['TO_NAME'] . "</font></td>";  
  
  echo "<td align=center width='2%'><font  face=monospace color=black size='3pt'>" . $row['CAT'] . "</font></td>";

  echo "<td  width='22%' nowrap><font face=monospace color=$colorfrom size='3pt'>" . $row['FROM_TYPE'] . "<br></font>";
echo " <font face=monospace color=$colorfrom size='3pt'><a href='./band_today_messages.php?from_mmsi=" . $row['RAW_FROM_MMSI'] . "&rx_freq=" . $row['RX_FREQ'] ."' style='color:$colorfrom' >" . $row['RAW_FROM_MMSI'] . "</a></font><br>";
//  echo " <font face=monospace color=$colorfrom size='3pt'>" . $row['RAW_FROM_MMSI'] . " </font><br>";
  if ($row['FROM_TYPE'] == "SHIP")
	  //echo "<font face=monospace color=black size='3pt'><a href=\"http://www.marinetraffic.com/en/ais/details/ships/mmsi:". $row['RAW_FROM_MMSI']."\">".$row['FROM_NAME']."</a></font><br><font face=monospace color=black size='3pt'>" . $row['FROM_CTRY'] . "</font></td>";
	  echo "<font face=monospace color=black size='3pt'><a href=\"https://www.myshiptracking.com/vessels/". $row['RAW_FROM_MMSI']."\">".$row['FROM_NAME']."</a></font><br><font face=monospace color=black size='3pt'>" . $row['FROM_CTRY'] . "</font></td>";
  else if ($row['FROM_TYPE'] == "COAST")
	  echo "<font face=monospace color=black size='3pt'>" . $row['FROM_NAME'] . "</font><br><font face = monospace color=black size='3pt'>" . $row['FROM_CTRY']. "</font></td>";
  else if ($row['FROM_TYPE'] == "GROUP")
	 echo "<font  face=monospace color=black size='3pt'>" . $row['FROM_NAME'] . "</font><br><font face=monospace color=black size='3pt'>" . $row['FROM_CTRY'] . "</font></td>";
  


  echo "<td width='5%'><font  face=monospace color=blue size='3pt'>" . $row['TC1'] . "<font></td>";
  echo "<td width='5%'><font  face=monospace color=blue size='3pt'>" . $row['TC2'] . "<font></td>";
  echo "<td width='11%'><font  face=monospace color=crimson size='3pt'>" . $row['FREQ'] . "<font></td>";
  echo "<td width='6%'><font  face=monospace color=crimson size='3pt'>" . $row['POS'] . "<font></td>";
  echo "<td align=center width='2%'><font  face=monospace color=blue size='3pt'>" . $row['EOS'] . "<font></td>";
//  echo "<td align=center width='5%'><font face=monospace color=#424242 size='3pt'>" . $row['ECC'] . "<font></td>";
echo "<td nowrap ><font face=monospace color='blue' size='3pt'><a href='./search_rx_freq.php?rxid=" . $row['RX_ID'] . "&rx_freq=" . $row['RX_FREQ']."' style='color:#541B66' >" . $row['RX_ID'] . "</a></font></td>"; 

// echo "<td width='8%' ><font  face=monospace color=#541b66 size='3pt'>" . $row['RX_ID'] . "</font></td>";
  echo "</tr>";
  
  $datetime = $row['DATETIME'];
  $rx_freq = $row['RX_FREQ'];
  $fmt = $row['FMT'];
  $to_type = $row['TO_TYPE'];
  $to_mmsi = $row['RAW_TO_MMSI'];
  $to_name = $row['TO_NAME'];
  $to_ctry = $row['TO_CTRY'];
  $cat = $row['CAT'];
  $from_type = $row['FROM_TYPE'];
  $from_mmsi = $row['RAW_FROM_MMSI'];
  $from_name = $row['FROM_NAME'];
  $from_ctry = $row['FROM_CTRY'];
  $tc1 = $row['TC1'];
  $tc2 = $row['TC2'];
  $freq = $row['FREQ'];
  $pos = $row['POS'];
  $eos = $row['EOS'];
  $ecc = $row['ECC'];
  $rx_id = $row['RX_ID'];
  $raw_dsc_message = $row['RAW_DSC_MESSAGE'];

   $output = "    Input :\t$raw_dsc_message\r\n     Time :\t$datetime\r\n  Monitor :\t$rx_id\r\nFrequency :\t$rx_freq kHz\r\n   Format :\t$fmt\r\n       To :\t$to_type\t$to_mmsi : $to_name : $to_ctry\r\n Category :\t$cat\r\n     From :\t$from_type\t$from_mmsi : $from_name : $from_ctry\r\n   Tele 1 :\t$tc1\r\n   Tele 2 :\t$tc2\r\n     Freq :\t$freq\r\n      Pos :\t$pos\r\n      EOS :\t$eos\r\n      ECC :\t$ecc\r\n\r\n"; 
  
  
  fwrite($f, $output);
  
  
  }
echo "</table>";
echo "</font>";



fclose($f);
mysqli_close($con);
?>
</center>
<center><br><a href="../../index.php">HOME</a></body>
</html>

