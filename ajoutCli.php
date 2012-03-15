<?php 
include("connect.php");
if ($_POST['nom'] && $_POST['ad1'] && $_POST['adVille'] && $_POST['adCP']){
    $req = mysql_query("INSERT INTO CLIENT VALUES (NULL,'".$_POST['nom']."','".$_POST['ad1'].'$'.$_POST['ad2']."','".$_POST['adVille']."','".$_POST['adCP']."');") or die(mysql_error());
	$return['error'] = false;
	$return['msg'] = "Le client: ".$_POST['nom']." a bien été enregistré!";
}else{
	$return['error'] = true;
	$return['msg'] = "Le formulaire n'a pas été correctement remplie!";
}
echo json_encode($return);
?>
