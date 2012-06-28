<?php

$id=trim($_POST['id']);
$desig=trim(strtoupper($_POST['desig']));

if ($desig){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APP_DESI WHERE DESIGNATION='$desig';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $req = mysql_query("INSERT INTO APP_DESI VALUES (NULL,'$desig');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "La désignation: ".$desig." a bien été enregistré!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "La désignation: ".$desig." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
