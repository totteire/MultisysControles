<?php
$id=trim($_POST['id']);
$desig=trim($_POST['desig']);
$marque=trim($_POST['marque']);
$type=trim($_POST['type']);

if (!$id||!$desig||!$marque||!$type){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APPAREIL WHERE TYPE='$type' AND DESIGNATION='$desig' AND MARQUE='$marque';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        // Modification de l'appareil
	    $req = mysql_query("UPDATE APPAREIL SET DESIGNATION='$desig', MARQUE='$marque', TYPE='$type' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "L'appareil: ".$desig." ".$marque." ".$type." a bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "L'appareil: ".$desig." ".$marque." ".$type." existe déja!";
    }
}
echo json_encode($return);
?>
