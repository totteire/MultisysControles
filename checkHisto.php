<?php 
    include('connect.php');
    $res = mysql_query("SELECT * FROM HISTORIQUE;")or die(mysql_error());
    $return['empty'] = true;
    if(mysql_num_rows($res) > 0){
	$return['empty'] = false;
    }
    echo json_encode($return);
?>
