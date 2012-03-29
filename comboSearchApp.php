<?php
include('connect.php');
$field = $_GET['field'];
$knownField = $_GET['knownField'];
$term = $_GET['term'];
$qstring = "SELECT $field FROM APPAREIL WHERE $knownField like '%$term%';";
$result = mysql_query($qstring)or die(mysql_error());
while ($row = mysql_fetch_array($result)){
		echo "<option>".$row[$field]."</option>";
}

?>
