<?php

include('../connect.php');

if(isset($_POST['radioType'])) $type = $_POST['radioType'];
if(isset($_POST['radioLieu'])) $lieu = $_POST['radioLieu'];
$num = $_POST['num'];
$cli = $_POST['cli'];
$app = $_POST['app'];
$numS = $_POST['numS'];
$numC = $_POST['numC'];
$date = date("Y-m-d", strtotime($_POST['date']));
$tech = $_POST['tech'];
$jugement = $_POST['jugement'];
$observation = $_POST['observation'];

if($num&&$type&&$lieu&&$cli&&$app&&$tech&&$date&&$jugement){
    
    $req = mysql_query("INSERT INTO CONTROLE VALUES (NULL,'$num','$app','$cli','$type','$date','$tech','$lieu','$jugement','$observation','$numS','$numC','',0);") or die(mysql_error());
    $return['error'] = false;
    $return['msg'] = "Le controle N°".$num." à bien été ajouté!";
}else{
    $return['error']=true;
    $return['msg']="tous les champs ne sont pas remplis!";
}

echo json_encode($return);
?>
