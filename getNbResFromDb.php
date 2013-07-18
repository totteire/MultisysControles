<?php
    include("connect.php");
    $req1 = "SELECT value FROM OPTIONS WHERE name = 'nbRes';";
    $result1 = mysql_query($req1)or die(mysql_error());
    while($res = mysql_fetch_array($result1)){
        $result['nbRes'] = $res['value'];
    }
    echo json_encode($result);
?>
