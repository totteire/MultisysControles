<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Requete local
	$nom=trim($_POST['nom']);
	$ad1=trim($_POST['ad1']);
	$ad2=trim($_POST['ad2']);
	$adVille=trim($_POST['adVille']);
	$adCP=trim($_POST['adCP']);
}else{
	// Requete distante
	$nom=$_GET['NOM'];
	$adresse=$_GET['ADRESSE'];
	$adVille=$_GET['AD_VILLE'];
	$adCP=$_GET['AD_CP'];
}
if ($nom && $ad1 && $adVille && $adCP){
    include("../connect.php");
    $test = mysql_query("SELECT ID FROM CLIENT WHERE NOM='$nom';")or die(mysql_error());
    if (mysql_num_rows($test)==0){
		// concaténation des champs d'adresses si la requete est local sinon l'adresse est déja concaténée
		if(!isset($adresse)) $adresse = $ad1.'$'.$ad2;
        $req = mysql_query("INSERT INTO CLIENT VALUES (NULL,'$nom','$adresse','$adVille','$adCP');") or die(mysql_error());
    	$return['error'] = false;
	    $return['msg'] = "Le client: ".$nom." a bien été enregistré!";
	}else{    
        $return['error'] = true;
	    $return['msg'] = "Le client: ".$nom." existe déja!";
	}
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
if isset($_GET['callback']) 
	echo $_GET['callback'].'('. json_encode($return).')'; 
else 
	echo json_encode($return);
?>
