<?php
$id=trim($_POST['id']);
$nom=addslashes(trim($_POST['nom']));
$signature=addslashes(trim($_POST['signature']));

if (!$id||!$nom||!$signature){
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}else{
    include("../connect.php");
    $test = mysql_query("SELECT ID FROM TECHNICIEN WHERE TECH='$nom' AND ID<>$id;")or die(mysql_error());
    if (mysql_num_rows($test)==0){
	    // Modification du Technicien
	    $req = mysql_query("UPDATE TECHNICIEN SET TECH='$nom', SIGNATURE='$signature' WHERE ID='$id';") or die(mysql_error());
	    $return['error'] = false;
	    $return['msg'] = "Le technicien: ".$nom." a bien été modifié!";
	}else{
        $return['error'] = true;
	    $return['msg'] = "Le technicien: ".$nom." existe déja!";
	}
}
echo json_encode($return);
?>
