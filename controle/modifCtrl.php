<?php

include('../connect.php');
$id = $_POST['id'];
$pdf_edit = $_POST['pdf_edit'];
if(isset($_POST['radioType'])) $type = $_POST['radioType']; else $type = "";
if(isset($_POST['radioLieu'])) $lieu = $_POST['radioLieu']; else $lieu = "";
$num = $_POST['num'];
$cli = $_POST['cli'];
$app = $_POST['app'];
$numS = $_POST['numS'];
$numC = $_POST['numC'];
$date = date("Y-m-d", strtotime($_POST['date']));
if(!isset($_POST['tech'])) $tech = ""; else $tech = $_POST['tech'];
$jugement = $_POST['jugement'];
$observation = $_POST['observation'];
$PAR = $_POST['PAR'];
$MM = $_POST['MM'];

switch($type){
    case "essa":
        $verifChamps = ($num&&$type&&$lieu&&$cli&&$app&&($numC||$numS)&&$tech&&$date&&$jugement)? true : false;
        break;
    case "veri":
        $verifChamps = ($num&&$type&&$lieu&&$cli&&$app&&($numC||$numS)&&$PAR&&$MM&&$tech&&$date&&$jugement)? true : false;
        break;
    case "etal":
        $verifChamps = ($num&&$type&&$lieu&&$cli&&$app&&($numC||$numS)&&$PAR&&$MM&&$tech&&$date)? true : false;
        break;
    default:
        $verifChamps = false;
}

if($verifChamps){
    $test = mysql_query("SELECT NUM FROM CONTROLE WHERE NUM = $num AND ID <> $id;") or die(mysql_error());
    if (mysql_num_rows($test)==0){
        $reqModifCtrl = mysql_query("UPDATE CONTROLE SET NUM='$num', ID_CONCERNER='$app', ID_AVOIR='$cli', TYPE_CTRL='$type', DATE='$date', TECHNICIEN='$tech', LIEU='$lieu', JUGEMENT='$jugement', OBSERVATION='$observation', NUM_SERIE='$numS', NUM_CHASSIS='$numC', PDF_EDIT='$pdf_edit', EX=0 WHERE ID='$id';") or die(mysql_error());
#        $reqID = mysql_query("SELECT ID FROM CONTROLE WHERE NUM=$num;")or die(mysql_error());
#        $resID = mysql_fetch_array($reqID);
        $reqDelFKmm = mysql_query("DELETE FROM UTILISER WHERE ID=$id;") or die(mysql_error());
        $reqDelFKpar = mysql_query("DELETE FROM VERIFIER WHERE ID=$id;") or die(mysql_error());
        if(!$PAR) $PAR = array();
        else $PAR = explode(',',$PAR);
        foreach($PAR as $par){
            $req2 = mysql_query("INSERT INTO VERIFIER VALUES ('".$id."','$par');") or die(mysql_error());
        }
        if(!$MM) $MM = array();
        else $MM = explode(',',$MM);
        foreach($MM as $mm){
            $req3 = mysql_query("INSERT INTO UTILISER VALUES ('".$id."','$mm')") or die(mysql_error());
        }
        $return['error'] = false;
        $return['msg'] = "Le controle N°".$num." à bien été modifié!";
    }else{
        $return['error'] = true;
        $return['msg'] = "Le controle N°".$num." existe déja!";
    }
}else{
    $return['error']=true;
    $return['msg']="tous les champs ne sont pas remplis!";
}

echo json_encode($return);
?>
