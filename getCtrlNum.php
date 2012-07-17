<?php
    include('./connect.php');
    // RENVOI UN NUMERO CONCATÉNANT DATE ET 2 CHIFFRES
    if(isset($_GET['date'])){
	$jj = substr($_GET['date'],0,2);
	$mm = substr($_GET['date'],3,2);
	$aaaa = substr($_GET['date'],6,4);
	$date = new DateTime();
	$date->setDate((int)($aaaa),(int)($mm),(int)($jj));
	$date = date('ymd', $date->format('U'));
    }else 
	$date = date('ymd');
    $req = "SELECT NUM FROM CONTROLE WHERE LIEU='S' AND NUM LIKE '".$date."__';";
    $result = mysql_query($req)or die(mysql_error());
    $numRow = mysql_num_rows($result) + 1;
    if($numRow > 9) $numRow = (string) $numRow;
    else $numRow = '0'.((string) $numRow);
    $num = ''.$date.$numRow;
    echo $num;
?>
