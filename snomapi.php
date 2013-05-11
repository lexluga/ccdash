<?php
$nr = $_GET["nr"];

// Extensions allowed to be monitored
$allowed = array(10, 11, 12);
if (!in_array($nr, $allowed)) {
    die();
}

$sqluser = "";
$sqlpass = "";
$sqldb = "ccdash";
$sqltbl = "agents";

$name = $_GET["name"];
$dnd = $_GET["dnd"];
$offhook = $_GET["offhook"];
$verbindung = mysql_connect ("localhost", $sqluser, $sqlpass) or die ("Wrong SQL credentials");
mysql_select_db($sqldb) or die ("Database doesn't exists");
$ergebnis = mysql_query("SELECT nr FROM $sqltbl WHERE nr = '$nr'") or die("Failure");;
$anzahl = mysql_num_rows($ergebnis);
if ($anzahl == 1) {
        if ($dnd != "") {
                $update = mysql_query("UPDATE $sqltbl SET name = '$name', dnd = '$dnd' WHERE nr = '$nr'");
        } else {
                $update = mysql_query("UPDATE $sqltbl SET name = '$name', offhook = '$offhook' WHERE nr = '$nr'");
        }
} else {
        if ($dnd != "") {
                $eintragen = mysql_query("INSERT INTO $sqltbl (nr, name, dnd) VALUES ('$nr', '$name', '$dnd')");
        } else {
                $eintragen = mysql_query("INSERT INTO $sqltbl (nr, name, offhook) VALUES ('$nr', '$name', '$offhook')");
        }
}
?>
