<?php
$num = $_POST['id'];
include("../connect.php");
$req1 = "DELETE FROM PARAMETRE WHERE ID = $num";
$res1 = mysql_query($req1) or die(mysql_error());
if($res1){
	$return['error'] = false;
	$return['msg'] = "Le paramètre a bien été supprimé!";
}else{
	$return['error'] = true;
	$return['msg'] = "Il y a eu une erreur!";
}
echo json_encode($return);
?>
