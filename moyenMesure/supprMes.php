<?php
    $num = $_POST['id'];
    include("../connect.php");
    $reqDlFk = "DELETE FROM AVOIRPARDEFAUT WHERE ID = $num";
    $req1 = "DELETE FROM MOYEN_MESURE WHERE ID = $num";
    $resDlFk = mysql_query($reqDlFk)or die(mysql_error());
    $res1 = mysql_query($req1) or die(mysql_error());
    if($res1 && $resDlFk){
	    $return['error'] = false;
	    $return['msg'] = "Le moyen de mesure a bien été supprimé!";
    }else{
	    $return['error'] = true;
	    $return['msg'] = "Il y a eu une erreur!";
    }
    echo json_encode($return);
?>
