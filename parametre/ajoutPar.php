<?php

$id=trim($_POST['id']);
$libelle=trim(strtoupper($_POST['libelle']));

if ($libelle){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM PARAMETRE WHERE LIBELLE='$libelle';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $req = mysql_query("INSERT INTO PARAMETRE VALUES (NULL,'$libelle');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "Le paramètre: ".$libelle." a bien été enregistré!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "Le paramètre: ".$libelle." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
