<?php
    $ids=$_POST['ids'];
    $idPar=$_POST['idPar'];
    if(!$ids) $ids = array();
    else $ids = explode(',',$ids);
    include("connect.php");
    $req1 = "SELECT AVOIRPARDEFAUT.ID, LIBELLE FROM AVOIRPARDEFAUT, MOYEN_MESURE WHERE AVOIRPARDEFAUT.ID=MOYEN_MESURE.ID AND ID_1=$idPar";
    $result1 = mysql_query($req1)or die(mysql_error());
    $tabMMexistant = array();
    $return['msg']="";
    while($res = mysql_fetch_array($result1)){
        array_push($tabMMexistant,$res['ID']);
        # si $res n'est pas dans ids alors supprimer $res
        if(!in_array($res['ID'], $ids)){
            $reqSuppr = "DELETE FROM AVOIRPARDEFAUT WHERE ID=".$res['ID']." AND ID_1=$idPar;";
            $resSuppr = mysql_query($reqSuppr) or die(mysql_error());
            $return['msg'].="suppression de ".$res['LIBELLE']."<br>";
        }
    }
    $nbNouv = 0;
    foreach($ids as $id){
        if(!in_array($id, $tabMMexistant)){
            # créer le lien
            $nbNouv ++;
            $reqAjout = "INSERT INTO AVOIRPARDEFAUT VALUES('$id','$idPar');";
            $resAjout = mysql_query($reqAjout)or die (mysql_error());
        }
    }
    $return['msg'].="ajout de ".$nbNouv." nouveaux moyens de mesure<br>";
    $return['error'] = false;
    echo json_encode($return);
?>
