<?php
								# syncModif.php #
    header("content-type: application/json");
    include('./connect.php');
    
    $table = $_GET['TABLE'];
    $occur = $_GET['OCCUR'];
    $type = $_GET['TYPE'];
    $id = $_GET['ID_MODIF'];
    
    $getTableNames = mysql_query("select column_name from information_schema.columns where table_name='".$table."';");
    $names = array();
    while($res = mysql_fetch_object($getTableNames)){
	array_push($names, $res->column_name);
    }
    
    switch($type){
	case 'A':
	    $req = "INSERT INTO ".$table." VALUES(NULL,";
	    for($i=1; $i<= count($names)-1; $i++){
		$req .= "'".$occur[$names[$i]]."'";
		if($i != count($names)-1) $req .= ",";
	    }
	    $req .= ");";
	    break;
	case 'M':
	    $req = "UPDATE ".$table." SET";
	    for($i=1; $i<= count($names)-1; $i++){
		$req .= " ".$names[$i]."='".$occur[$names[$i]]."'";
		if($i != count($names)-1) $req .= ",";
	    }
	    $req .= " WHERE ID=".$id.";";
	    break;
	case 'S':
	    $req = "DELETE FROM ".$table." WHERE ID=".$id.";";
	    break;
    }
    mysql_query($req);
    
    $return->requete = $req;
    echo $_GET['callback'].'('.json_encode($return).')';
?>
