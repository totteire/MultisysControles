<?php
    $DATE = date("Y-m-d", strtotime($_GET['date']));
    include('connect.php');
	$req="SELECT * FROM CONTROLE WHERE DATE='$DATE' AND LIEU='S';";
	$result=mysql_query($req) or die(mysql_error());
    $client = 0;
	$nb = 0;
	if(mysql_num_rows($result) != 0){
	    while($res = mysql_fetch_array($result)){
            $nb++;
            $client = (int) $res['ID_AVOIR'];
	    }
	}
	$return['nb'] = $nb;
	$return['cli'] = $client;
	echo json_encode($return);
?>
