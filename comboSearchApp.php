<?php
include('connect.php');
$field = $_GET['field'];
$knownField = $_GET['knownField'];
$term = $_GET['term'];
if($field == 'TYPE') $qstring = "SELECT $field,ID FROM APPAREIL WHERE $knownField like \"%$term%\";";
else $qstring = "SELECT DISTINCT $field FROM APPAREIL WHERE $knownField like \"%$term%\";";
$result = mysql_query($qstring)or die(mysql_error());
while ($row = mysql_fetch_array($result)){
    if($field == 'TYPE')
		echo "<option value='".$row['ID']."'>".$row[$field]."</option>";
	else
	    echo "<option value='".$row[$field]."'>".$row[$field]."</option>";
}

?>
