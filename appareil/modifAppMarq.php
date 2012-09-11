<?php
$id=trim($_POST['id']);
$marque=trim(strtoupper(strtoupper($_POST['marque'])));

if (!$id||!$marque){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APP_MARQUE WHERE MARQUE='$marque' AND ID<>$id;")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        // Modification de l'appareil
	    $req = mysql_query("UPDATE APP_MARQUE SET MARQUE='$marque' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "La marque: ".$marque." a bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "La marque: ".$marque." existe déja!";
    }
}
echo json_encode($return);
?>
