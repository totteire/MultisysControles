<?php
$id=trim($_POST['id']);
$desig=trim($_POST['desig']);

if (!$id||!$desig){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT * FROM APP_DESI WHERE DESIGNATION='$desig' AND ID<>$id;")or die(mysql_error());
    if (mysql_num_rows($test)==0){
        // Modification de l'appareil
	    $req = mysql_query("UPDATE APP_DESI SET DESIGNATION='$desig' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "La désignation: ".$desig." a bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "La désignation: ".$desig." existe déja!";
    }
}
echo json_encode($return);
?>
