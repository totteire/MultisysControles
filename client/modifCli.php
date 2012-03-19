<?php
$id=trim($_POST['id']);
$nom=trim($_POST['nom']);
$ad1=trim($_POST['ad1']);
$ad2=trim($_POST['ad2']);
$adVille=trim($_POST['adVille']);
$adCP=trim($_POST['adCP']);

if (!$id||!$nom||!$ad1||!$adVille||!$adCP){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT ID FROM CLIENT WHERE NOM='$nom';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
	    // Modification du Client
	    $req = mysql_query("UPDATE CLIENT SET NOM='$nom', ADRESSE='".$ad1."$".$ad2."', AD_VILLE='$adVille', AD_CP='$adCP' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "Le client: ".$nom." a bien été modifié!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "Le client: ".$nom." existe déja!";
	}
}
echo json_encode($return);
?>
