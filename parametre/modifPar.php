<?php
$id=trim($_POST['id']);
$libelle=trim($_POST['libelle']);

if (!$libelle){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT * FROM PARAMETRE WHERE LIBELLE='$libelle' AND ID<>$id;")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        // Modification du Paramètre
	    $req = mysql_query("UPDATE PARAMETRE SET LIBELLE='$libelle' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "Le paramètre: ".$libelle." a bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "Le paramètre: ".$libelle." existe déja!";
    }
}
echo json_encode($return);
?>
