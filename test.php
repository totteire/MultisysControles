<?php 
    include('connect.php');
    $res = mysql_query("SELECT * FROM HISTORIQUE;")or die(mysql_error());
    $return['empty'] = true;
    die(mysql_num_rows($res));
    if(mysql_num_rows($res) > 0){
	$return['empty'] == false;
    }
    return(json_encode($return));
?>
