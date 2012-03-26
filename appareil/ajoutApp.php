<?php

$id=trim($_POST['id']);
$desig=trim($_POST['desig']);
$marque=trim($_POST['marque']);
$type=trim($_POST['type']);

if ($desig && $marque && $type){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APPAREIL WHERE TYPE='$type' AND DESIGNATION='$desig' AND MARQUE='$marque';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $req = mysql_query("INSERT INTO APPAREIL VALUES (NULL,'$desig','$marque','$type');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "L'appareil: ".$desig." ".$marque." ".$type." a bien été enregistré!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "L'appareil: ".$desig." ".$marque." ".$type." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
