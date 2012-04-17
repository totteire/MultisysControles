<?php
    include("connect.php");
    
	$getModif = mysql_query("SELECT * FROM HISTORIQUE") or die(mysql_error());
	$modif = array();
	while($resHisto = mysql_fetch_object($getModif)){
		$getOccur = mysql_query("SELECT * FROM ".$resHisto->TABLE." WHERE ID = ".$resHisto->ID_MODIF.";") or die(mysql_error());
		$resHisto->OCCUR =  mysql_fetch_object($getOccur);
        array_push($modif, $resHisto);
	}
	echo json_encode($modif);
?>
