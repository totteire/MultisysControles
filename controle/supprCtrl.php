<?php
    $id = $_POST['id'];
    include("../connect.php");

    $resDlFKpar = mysql_query("DELETE FROM VERIFIER WHERE ID = $id;")or die(mysql_error());
    $resDlFKmm = mysql_query("DELETE FROM UTILISER WHERE ID = $id;")or die(mysql_error());
    $res1 = mysql_query("DELETE FROM CONTROLE WHERE ID = $id") or die(mysql_error());
    
    if($res1 && $resDlFKmm && $resDlFKpar){
	    $return['error'] = false;
	    $return['msg'] = "Le moyen de mesure a bien été supprimé!";
    }else{
	    $return['error'] = true;
	    $return['msg'] = "Il y a eu une erreur!";
    }
    echo json_encode($return);
?>
