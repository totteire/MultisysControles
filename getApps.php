<?php
    include('connect.php');
    #$field = $_GET['field'];
    #$knownField = $_GET['knownField'];
    #$term = $_GET['term'];
    #if($field == 'TYPE') $qstring = "SELECT $field,ID FROM APPAREIL WHERE $knownField like \"%$term%\";";
    #else $qstring = "SELECT DISTINCT $field FROM APPAREIL WHERE $knownField like \"%$term%\";";
    #$result = mysql_query($qstring)or die(mysql_error());
    #while ($row = mysql_fetch_array($result)){
    #    if($field == 'TYPE')
    #		echo "<option value='".$row['ID']."'>".$row[$field]."</option>";
    #	else
    #	    echo "<option value='".$row[$field]."'>".$row[$field]."</option>";
    #}

    $desi = array();
    $marque = array();
    $type = array();
    $req = "select * from APP_DESI;";
    $result = mysql_query($req)or die(mysql_error());
    while($res=mysql_fetch_object($result)){
	array_push($desi, $res);
    }

    $req = "select * from APP_MARQUE;";
    $result = mysql_query($req)or die(mysql_error());
    while($res=mysql_fetch_object($result)){
	array_push($marque, $res);
    }


    $req = "select * from APP_TYPE;";
    $result = mysql_query($req)or die(mysql_error());
    while($res=mysql_fetch_object($result)){
	array_push($type, $res);
    }

    $return['desi'] = $desi;
    $return['marque'] = $marque;
    $return['type'] = $type;

    echo json_encode($return);
?>
