<?php
$num = $_POST['id'];
include("../connect.php");
$req1 = "DELETE FROM MOYEN_MESURE WHERE ID = $num";
$res1 = mysql_query($req1) or die(mysql_error());
if($res1){
	$return['error'] = false;
	$return['msg'] = "Le moyen de mesure a bien été supprimé!";
}else{
	$return['error'] = true;
	$return['msg'] = "Il y a eu une erreur!";
}
echo json_encode($return);
?>
