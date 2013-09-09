<?php

include('../connect.php');

if(isset($_POST['radioType'])) $type = $_POST['radioType']; else $type = "";
if(isset($_POST['radioLieu'])) $lieu = $_POST['radioLieu']; else $lieu = "";
$num = trim($_POST['num']);
$cli = $_POST['cli'];
$app_desi = $_POST['appDesi'];
$app_marque = $_POST['appMarque'];
$app_type = $_POST['appType'];
$numS = trim($_POST['numS']);
$numC = trim($_POST['numC']);
$date = date("Y-m-d", strtotime($_POST['date']));
$temp = trim($_POST['temp']);
$tech = $_POST['tech'];
if($tech == "%" || $tech == "") $tech = 1;
$jugement = $_POST['jugement'];
$observation = addslashes(trim($_POST['observation']));
$PAR = $_POST['PAR'];
$MM = $_POST['MM'];
$docST = addslashes(trim($_POST['docST']));
$docNum = $_POST['docNum'];

if(($numS=='*') || ($numS == "")) $numS = "****";
if(($numC=='*') || ($numC == "")) $numC = "****";

switch($type){
    case "ACE":
	if($tech == 1)
	    $verifChamps = ($num&&$type&&$lieu&&$cli&&$app_desi&&$app_marque&&$app_type&&$date)? true : false; 
	else
	    $verifChamps = ($num&&$type&&$lieu&&$cli&&$app_desi&&$app_marque&&$app_type&&$date&&$jugement)? true : false;
        break;
    case "CV":
	if($tech == 1)
	    $verifChamps = ($num&&$type&&$lieu&&$cli&&$app_desi&&$app_marque&&$app_type&&$date)? true : false;
	else
	    $verifChamps = ($num&&$type&&$lieu&&$cli&&$app_desi&&$app_marque&&$app_type&&$PAR&&$MM&&$date&&$jugement)? true : false;
        break;
    case "CE":
	if($tech == 1)
	    $verifChamps = ($num&&$type&&$lieu&&$cli&&$app_desi&&$app_marque&&$app_type&&$date)? true : false;
	else
	    $verifChamps = ($num&&$type&&$lieu&&$cli&&$app_desi&&$app_marque&&$app_type&&$MM&&$date)? true : false;
        break;
    case "FI":
	$verifChamps = ($num&&$type&&$cli&&$app_desi&&$app_marque&&$app_type&&$date&&$docST&&$docNum)? true : false;
	break;
    default:
        $verifChamps = false;
}

if($verifChamps){
    $test = mysql_query("SELECT NUM FROM CONTROLE WHERE NUM = '$num';") or die(mysql_error());
    if (mysql_num_rows($test)==0){
    
        # Check if there is a new app to add
        if (strpbrk($app_desi, '%')){
            $app_desi = strtoupper(str_replace('%', '', $app_desi));
            mysql_query("INSERT INTO APP_DESI VALUES ('NULL','$app_desi')");
            $getIdDesi = mysql_query("SELECT ID FROM APP_DESI WHERE DESIGNATION='$app_desi';") or die(mysql_error());
            $app_desi = mysql_result($getIdDesi,0);
        }
        if (strpbrk($app_marque, '%')){
            $app_marque = strtoupper(str_replace('%', '', $app_marque));
            mysql_query("INSERT INTO APP_MARQUE VALUES ('NULL','$app_marque')");
            $getIdMarq = mysql_query("SELECT ID FROM APP_MARQUE WHERE MARQUE='$app_marque';") or die(mysql_error());
            $app_marque = mysql_result($getIdMarq,0);
        }
        if (strpbrk($app_type, '%')){
            $app_type = strtoupper(str_replace('%', '', $app_type));
            mysql_query("INSERT INTO APP_TYPE VALUES ('NULL','$app_type')");
            $getIdType = mysql_query("SELECT ID FROM APP_TYPE WHERE TYPE='$app_type';") or die(mysql_error());
            $app_type = mysql_result($getIdType,0);
        }
	if (strpbrk($docST, '%'))
	    $docST = strtoupper(str_replace('%', '', $docST));
    
        $reqInserCtrl = mysql_query("INSERT INTO CONTROLE VALUES (NULL,'$num','$app_desi','$app_marque','$app_type','$cli','$type','$date','$tech','$temp','$lieu','$jugement','$observation','$numS','$numC','','$docST','$docNum');") or die(mysql_error());
        $reqID = mysql_query("SELECT ID FROM CONTROLE WHERE NUM='$num';")or die(mysql_error());
        $resID = mysql_fetch_array($reqID);
        if(!$PAR) $PAR = array();
        else $PAR = explode(',',$PAR);
        foreach($PAR as $par){
            $req2 = mysql_query("INSERT INTO VERIFIER VALUES ('".$resID['ID']."','$par');") or die(mysql_error());
        }
        if(!$MM) $MM = array();
        else $MM = explode(',',$MM);
        foreach($MM as $mm){
            $req3 = mysql_query("INSERT INTO UTILISER VALUES ('".$resID['ID']."','$mm')") or die(mysql_error());
        }
        $return['error'] = false;
        $return['msg'] = "Le controle N°".$num." à bien été ajouté!";
    }else{
        $return['error'] = true;
        $return['msg'] = "Le controle N°".$num." existe déja!";
    }
}else{
    $return['error']=true;
    $return['msg']="tous les champs ne sont pas remplis!";
#    $return['test']="".$num." ".$type." ".$lieu." ".$cli." ".$app." ".$tech." ".$date." ".$jugement." ".$MM;
}

echo json_encode($return);
?>
