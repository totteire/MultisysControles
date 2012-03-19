<?php

$id=trim($_POST['id']);
$nom=trim($_POST['nom']);
$ad1=trim($_POST['ad1']);
$ad2=trim($_POST['ad2']);
$adVille=trim($_POST['adVille']);
$adCP=trim($_POST['adCP']);

if ($nom && $ad1 && $adVille && $adCP){
    include("../connect.php");
    $test = mysql_query("SELECT ID FROM CLIENT WHERE NOM='$nom';")or die(mysql_error());
    if (mysql_num_rows($test)==0){	    
        $req = mysql_query("INSERT INTO CLIENT VALUES (NULL,'$nom','".$ad1."$".$ad2."','$adVille','$adCP');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "Le client: ".$nom." a bien été enregistré!";
	}else{    
        $return['error'] = true;
	    $return['msg'] = "Le client: ".$nom." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
