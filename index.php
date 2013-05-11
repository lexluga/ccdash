<?php
$sqluser = "";
$sqlpass = "";
$sqldb = "ccdash";
$sqltbl = "agents";
$verbindung = mysql_connect ("localhost", $sqluser, $sqlpass) or die ("Wrong credentials");
mysql_select_db($sqldb) or die ("DB does'T exists");
$ergebnis = mysql_query("SELECT * FROM $sqltbl ORDER BY name ASC") or die("Failure");;
$anzahl = mysql_num_rows($ergebnis);

$time1 = new DateTime("2011-01-26 01:13:30"); // string date
$time2 = new DateTime();
//$time2->setTimestamp(1327560334); // timestamps,  it can be string date too.
$interval = $time2->diff($time1);
//echo $interval->format("%H hours %i minutes %s seconds");
//print_r( $interval);

print '<meta http-equiv="refresh" content="30">';
echo "<table border='1'>";
print "<th>Name</th><th>Durchwahl</th><th>Status</th><th>Seit</th>";
while($row = mysql_fetch_object($ergebnis))
{
        $time1 = new DateTime($row->ts);
        $time2 = new DateTime();
        $interval = $time2->diff($time1);
        $dif = $interval->format("%d Tage %H Stunden %i Minuten %s Sekunden");
        if ($row->dnd == 1) {
  echo "<tr>";
  echo "<td>",$row->name,"</td>";
  echo "<td>",$row->nr,"</td>";
  echo "<td>nicht am Platz";
  echo "<td>",$dif,"</td>";
  //print_r($interval);
  echo "</tr>";
        } else if ($row->offhook == 1) {
  echo "<tr>";
  echo "<td>",$row->name,"</td>";
  echo "<td>",$row->nr,"</td>";
  echo "<td>im Gespraech";
  echo "<td>",$dif,"</td>";
  echo "</tr>";
        }
}
echo "</table>";


?>
