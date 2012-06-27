<?php

$id=trim($_POST['id']);
$type=trim($_POST['type']);

if ($type){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APP_TYPE WHERE TYPE='$type';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $req = mysql_query("INSERT INTO APP_TYPE VALUES (NULL,'$type');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "Le type: ".$type." a bien été enregistré!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "Le type: ".$type." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
