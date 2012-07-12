<?php
    // RENVOI UN NUMERO CONCATÉNANT DATE ET 2 CHIFFRES
    if(isset($_GET['date'])) $date = date('ymd',$_GET['date']);else $date = date('ymd');
    $req = "SELECT NUM FROM CONTROLE WHERE LIEU='S' AND NUM LIKE '".$date."__';";
    $result = mysql_query($req)or die(mysql_error());
    $numRow = mysql_num_rows($result) + 1;
    if($numRow > 9) $numRow = (string) $numRow;
    else $numRow = '0'.((string) $numRow);
    $num = ''.date('ymd').$numRow;
    echo $num;
?>
