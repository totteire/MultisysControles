<?php 
if ($POST['nom'] && $POST['ad1'] && $POST['adVille'] && $POST['adCP'])
    $req = mysql_query("INSERT INTO CLIENT VALUES (NULL,'".$POST['nom']."','".$POST['ad1'].$POST['ad2'].".".$POST['adVille']."','".$POST['adCP']."');") or die(mysql_error());
else
#    error

?>
