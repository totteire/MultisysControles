<?php 
    include('connect.php');
    $req = "select DISTINCT TYPE from APPAREIL;";
    $res = mysql_query($req);
    while ($occur = mysql_fetch_array($res)){
        $req1 = "INSERT INTO APP_TYPE VALUES(NULL, \"".$occur['TYPE']."\");";
        $ajout = mysql_query($req1)or die(mysql_error());
    }
?>
