 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html" />
</head>
 <body bgcolor="c8d5e6">
	<basefont face="Arial">
<center>


<?php
  









$con=mysqli_connect("localhost","yadd","yaddpwd","yadd");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$result = mysqli_query($con, " select * from test");


echo "Text file output for copying into documents/email etc <br>";      
echo "Click to read or 'Right Click' to Save As...<a href=".$file.">File output</a>  :<br><br>";     
      


echo "<table border='0' cellpadding='5' rules='all'>
<tr>
<th> <font face=monospace color=blue size='3pt'>Date</font></th>
<th><font face=monospace color=#424242 size='3pt'>Freq</font></th>
<th><font face=monospace color=black size='3pt'>RX</font></th>
</tr>";

while($row = mysqli_fetch_array($result))
{


  echo "<tr>";
  echo "<td width='6%'><font face=monospace color=blue size='3pt'>"  . $row['ONE'] . "</font> </td>";
  echo "<td width='4%'><font  face=monospace color=#424242 size='3pt'>" . $row['TWO'] . "</font></td>";
  echo "<td align=center width='2%'><font  face=monospace color=black size='3pt'>" . $row['THREE'] . "</font></td>";


  echo "</tr>";
  
  
  
  }
echo "</table>";
echo "</font>";


fclose($f);
mysqli_close($con);
?>
</center>
</html>

