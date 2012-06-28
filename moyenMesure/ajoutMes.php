<?php

$id=trim($_POST['id']);
$libelle=trim(strtoupper($_POST['libelle']));
$nomVerif=trim(strtoupper($_POST['nomVerif']));
$numDateVerif=trim(strtoupper($_POST['numDateVerif']));

if ($libelle && $nomVerif && $numDateVerif){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM MOYEN_MESURE WHERE LIBELLE='$libelle' AND NOM_VERIF='$nomVerif' AND NUM_DATE_VERIF='$numDateVerif';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $req = mysql_query("INSERT INTO MOYEN_MESURE VALUES (NULL,'$libelle','$nomVerif','$numDateVerif');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "Le moyen de mesure: ".$libelle." a bien été enregistré!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "Le moyen de mesure: ".$libelle." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
