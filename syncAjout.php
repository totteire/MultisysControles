<?php

	header("content-type: application/json");
	include('./MultisysControles/connect.php');
	
	$table = $_GET['TABLE'];
	$occur = $_GET['OCCUR'];
	
	$getTableNames = mysql_query("select column_name from information_schema.columns where table_name='".$table."';") or die(mysql_error());
	$names = array();
	while($res = mysql_fetch_object($getTableNames)){
    	 array_push($names, $res->column_name);
    }

    $req = "INSERT INTO ".$table." VALUES(NULL,";
    for($i=1; $i<= count($names)-1; $i++){
        $req .= "'".$occur[$names[$i]]."'";
        if($i != count($names)-1) $req .= ",";
    }
    $req .= ");";
    
	$return->requete = $req;
	echo $_GET['callback'].'('.json_encode($return).')';

?>
