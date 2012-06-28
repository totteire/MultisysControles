<?php

$id=trim($_POST['id']);
$marque=trim(strtoupper($_POST['marque']));

if ($marque){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APP_MARQUE WHERE MARQUE='$marque';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $req = mysql_query("INSERT INTO APP_MARQUE VALUES (NULL,'$marque');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "La marque: ".$marque." a bien été enregistré!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "La marque: ".$marque." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
