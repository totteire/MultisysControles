<?php

$host="localhost";
$username="root";
$password="toor";
$db_name="multisys";

// Connection à la  base de données
$connex = mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_query('set names utf8', $connex);
mysql_select_db("$db_name")or die("cannot select DB");

?>
