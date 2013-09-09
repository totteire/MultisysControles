<?php
$id=trim($_POST['id']);
$libelle=addslashes(trim($_POST['libelle']));
$nomVerif=trim($_POST['nomVerif']);
$numDateVerif=trim($_POST['numDateVerif']);
$order=trim($_POST['order']);

if (!$id||!$libelle||!$nomVerif||!$numDateVerif||!$order){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT * FROM MOYEN_MESURE WHERE LIBELLE='$libelle' AND NOM_VERIF='$nomVerif' AND NUM_DATE_VERIF='$numDateVerif' AND ID<>$id;")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        // Modification du moyen de mesure
	    $req = mysql_query("UPDATE MOYEN_MESURE SET LIBELLE='$libelle', NOM_VERIF='$nomVerif', NUM_DATE_VERIF='$numDateVerif', ORDRE='$order' WHERE ID='$id';") or die(mysql_error());
	    //if($nomVerif == "Vérification MULTISYS"){$reqUpdateMulti = mysql_query("UPDATE MOYEN_MESURE SET NUM_DATE_VERIF='$numDateVerif' WHERE NOM_VERIF='$nomVerif';")or die(mysql_error());}
	    $return['error'] = false;
	    $return['msg'] = "Le moyen de mesure: ".$libelle." a bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "Le moyen de mesure: ".$libelle." existe déja!";
    }
}
echo json_encode($return);
?>
