<?php

$id=trim($_POST['id']);
$nom=trim($_POST['nom']);
$signature=trim($_POST['signature']);

if ($nom){
    include("../connect.php");
    $test = mysql_query("SELECT ID FROM TECHNICIEN WHERE TECH='$nom';")or die(mysql_error());
    if (mysql_num_rows($test)==0){	    
        $req = mysql_query("INSERT INTO TECHNICIEN VALUES (NULL,'$nom','$signature');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "Le technicien: ".$nom." a bien été enregistré!";
	}else{    
        $return['error'] = true;
	    $return['msg'] = "Le technicien: ".$nom." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
