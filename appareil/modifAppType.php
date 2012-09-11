<?php
$id=trim($_POST['id']);
$type=trim(strtoupper(strtoupper($_POST['type'])));

if (!$id||!$type){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APP_TYPE WHERE TYPE='$type' AND ID<>$id;")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        // Modification de l'appareil
	    $req = mysql_query("UPDATE APP_TYPE SET TYPE='$type' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "Le type: ".$type." a bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "Le type: ".$type." existe déja!";
    }
}
echo json_encode($return);
?>
