<?php
$num = $_POST['num'];
$numS = $_POST['numS'];
$numC = $_POST['numC'];
$type = $_POST['radioType'];
$date = $_POST['date'];
$technicien = $_POST['technicien'];
$lieu = $_POST['radioLieu'];
$jugement = $_POST['jugement'];
$observation = $_POST['observation'];
$lol['error']=true;
$lol['msg']="LOL tas vraiment cru que ca aller marcher???";
echo json_encode($lol);
?>
