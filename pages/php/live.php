<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <title>
Live</title>
	<meta http-equiv="refresh" content="120">
  </head>
  <body bgcolor="c8d5e6">
	<basefont face="Ariel">

<center>
<h2> YaDDNet : MF/HF DSC Database</h2>

<h3>This view is of</h3>
<b>All</b> Messages, last 60 minutes : All connected YaDD monitors : All bands<br>
<br>
<br>

<?php


 

$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM newlog where datetime > date_sub(utc_timestamp(), interval 60 minute)  order by datetime desc");


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
//    echo "<td width='6%'><font face=monospace color=blue size='3pt'>"  . $row['DATETIME'] . "</font> </td>";
    echo "<td width='4%'><font  face=monospace color=#424242 size='3pt'>" . $row['RX_FREQ'] . "</font></td>";
    echo "<td align=center width='2%'><font  face=monospace color=black size='3pt'>" . $row['FMT'] . "</font></td>";
    
  echo "<td width='22%' nowrap><font face=monospace color=$colorto size='3pt'>" . $row['TO_TYPE'] . "<br></font>";

if ($row['TO_TYPE'] == "AREA")
  echo " <font face=monospace color=$colorto size='3pt'>" . $row['RAW_TO_MMSI'] . "</font><br>";
else


echo " <font face=monospace color=$colorto size='3pt'><a href='./band_today_messages.php?from_mmsi=" . $row['RAW_TO_MMSI'] . "&rx_freq=" . $row['RX_FREQ'] . "' style='color:$colorto' >" . $row['RAW_TO_MMSI'] . "</a></font><br>";

//  echo " <font face=monospace color=$colorto size='3pt'>" . $row['RAW_TO_MMSI'] . "</font><br>";
  
  if ($row['TO_TYPE'] == "SHIP")
  
  	echo "<font  face=monospace color=black size='3pt'><a href=\"http://www.marinetraffic.com/en/ais/details/ships/mmsi:". $row['RAW_TO_MMSI']."\">".$row['TO_NAME']."</a></font><br><font  face=monospace color=black size='3pt'>" . $row['TO_CTRY'] . "</font></td>";
    
  else if ($row['TO_TYPE'] == "COAST")

  	echo "<font  face=monospace color=black size='3pt'>" . $row['TO_NAME'] . "</font><br><font  face=monospace color=black size='3pt'>" . $row['TO_CTRY'] . "</font></td>";

  else if ($row['TO_TYPE'] == "GROUP")
  	echo "<font  face=monospace color=black size='3pt'>" . $row['TO_NAME'] . "</font><br><font  face=monospace color=black size='3pt'>" . $row['TO_CTRY'] . "</font></td>";
  
else if ($row['TO_TYPE'] == "ALL")
  	echo "<font  face=monospace color=black size='3pt'>" . $row['TO_NAME'] . "</font></td>";

  echo "<td align=center width='2%'><font  face=monospace color=black size='3pt'>" . $row['CAT'] . "</font></td>";
  
  echo "<td width='22%' nowrap ><font  face=monospace color=$colorfrom size='3pt'>" . $row['FROM_TYPE'] . "<br></font>";
echo " <font face=monospace color=$colorto size='3pt'><a href='./band_today_messages.php?from_mmsi=" . $row['RAW_FROM_MMSI'] . "&rx_freq=" . $row['RX_FREQ'] . "' style='color:$colorfrom' >" . $row['RAW_FROM_MMSI'] . "</a></font><br>";
//  echo " <font  face=monospace color=$colorfrom size='3pt'>" . $row['RAW_FROM_MMSI'] . "</font><br>";


  if ($row['FROM_TYPE'] == "SHIP")
	    
	          echo "<font  face=monospace color=black size='3pt'><a href=\"http://www.marinetraffic.com/en/ais/details/ships/mmsi:". $row['RAW_FROM_MMSI']."\">".$row['FROM_NAME']."</a></font><br><font  face=monospace color=black size='3pt'>" . $row['FROM_CTRY'] . "</font></td>";
      
    else if ($row['FROM_TYPE'] == "COAST")

	            echo "<font  face=monospace color=black size='3pt'>" . $row['FROM_NAME'] . "</font><br><font  face=monospace color=black size='3pt'>" . $row['FROM_CTRY'] . "</font></td>";

    
  else if ($row['FROM_TYPE'] == "GROUP")
  	echo "<font  face=monospace color=black size='3pt'>" . $row['FROM_NAME'] . "</font><br><font  face=monospace color=black size='3pt'>" . $row['FROM_CTRY'] . "</font></td>";
    
    
  echo "<td width='5%'><font  face=monospace color=blue size='3pt'>" . $row['TC1'] . "<font></td>";
  echo "<td width='5%'><font  face=monospace color=blue size='3pt'>" . $row['TC2'] . "<font></td>";
  echo "<td width='11%'><font  face=monospace color=crimson size='3pt'>" . $row['FREQ'] . "<font></td>";
  echo "<td width='6%'><font  face=monospace color=crimson size='3pt'>" . $row['POS'] . "<font></td>";
  echo "<td align=center width='2%'><font  face=monospace color=blue size='3pt'>" . $row['EOS'] . "<font></td>";
//  echo "<td align=center width='5%'><font face=monospace color=#424242 size='3pt'>" . $row['ECC'] . "<font></td>";

echo "<td nowrap ><font face=monospace size='3pt'><a href='./search_rx_freq.php?rxid=" . $row['RX_ID'] . "&rx_freq=" . $row['RX_FREQ']."' style='color:#541B66' >" . $row['RX_ID'] . "</a></font></td>";
 // echo "<td width='8%'><font  face=monospace color=#541b66 size='3pt'>" . $row['RX_ID'] . "</font></td>";

echo "</tr>"; }

echo "</table>";
echo "</font>";

mysqli_close($con);
?>
</center>
<center><br><a href="../../index.php">HOME</a></body>
</html>

