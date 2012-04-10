<?php

include('../connect.php');

if(isset($_POST['radioType'])) $type = $_POST['radioType']; else $type = "";
if(isset($_POST['radioLieu'])) $lieu = $_POST['radioLieu']; else $lieu = "";
$num = $_POST['num'];
$cli = $_POST['cli'];
$app = $_POST['app'];
$numS = $_POST['numS'];
$numC = $_POST['numC'];
$date = date("Y-m-d", strtotime($_POST['date']));
$tech = $_POST['tech'];
$jugement = $_POST['jugement'];
$observation = $_POST['observation'];
$PAR = $_POST['PAR'];
$MM = $_POST['MM'];

if($num&&$type&&$lieu&&$cli&&$app&&$tech&&$date&&$MM){
    
    $req = mysql_query("INSERT INTO CONTROLE VALUES (NULL,'$num','$app','$cli','$type','$date','$tech','$lieu','$jugement','$observation','$numS','$numC','',0);") or die(mysql_error());
    $reqID = mysql_query("SELECT ID FROM CONTROLE WHERE NUM=$num;")or die(mysql_error());
    $resID = mysql_fetch_array($reqID);
    if(!$PAR) $PAR = array();
    else $PAR = explode(',',$PAR);
    foreach($PAR as $par){
        $req2 = mysql_query("INSERT INTO VERIFIER VALUES ('".$resID['ID']."','$par');")or die(mysql_error());
    }
    if(!$MM) $MM = array();
    else $MM = explode(',',$MM);
    foreach($MM as $mm){
        $req3 = mysql_query("INSERT INTO UTILISER VALUES ('".$resID['ID']."','$mm')") or die(mysql_error());
    }
    
    $return['error'] = false;
    $return['msg'] = "Le controle N°".$num." à bien été ajouté!";
}else{
    $return['error']=true;
    $return['msg']="tous les champs ne sont pas remplis!";
    $return['test']="".$num." ".$type." ".$lieu." ".$cli." ".$app." ".$tech." ".$date." ".$jugement." ".$MM;
}

echo json_encode($return);
?>
