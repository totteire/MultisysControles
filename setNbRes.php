<?php
    include('connect.php');
    $nbRes = $_GET['nbRes'];
    mysql_query("update OPTIONS set value = ".$nbRes." where name = 'nbRes';") or die (mysql_error());
?>
