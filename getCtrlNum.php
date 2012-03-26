<?php
    // RENVOI UN NUMERO CONCATÉNANT DATE ET 2 CHIFFRES
    $req = "SELECT NUM FROM CONTROLE WHERE LIEU='S' AND NUM LIKE '".date('ymd')."__';";
    $result = mysql_query($req)or die(mysql_error());
    $numRow = mysql_num_rows($result);
    $return['num'] = ''.date('ymd').$numRow;
    echo json_encode($return['num']);
    
?>
