<?php

$id=trim($_POST['id']);
$libelle=addslashes(trim($_POST['libelle']));
$nomVerif=trim($_POST['nomVerif']);
$numDateVerif=trim($_POST['numDateVerif']);
$order=trim($_POST['order']);

if ($libelle && $nomVerif && $numDateVerif && $order){
    include("../connect.php");
    $test = mysql_query("SELECT * FROM MOYEN_MESURE WHERE LIBELLE='$libelle' AND NOM_VERIF='$nomVerif' AND NUM_DATE_VERIF='$numDateVerif';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        //if(strpos($nomVerif,'COFRAC')) $ordre = 1;
        //else if(strpos($nomVerif, 'CONSTAT'))$ordre = 2;
        //else if(strpos($nomVerif, 'MULTISYS'))$ordre = 3;
        //else $ordre = 0;

        $req = mysql_query("INSERT INTO MOYEN_MESURE VALUES (NULL,'$libelle','$nomVerif','$numDateVerif', '$order');") or die(mysql_error());
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
