<?php
    $ids=$_POST['ids'];
    if(!$ids) $ids = array();
    else $ids = explode(',',$ids);
    include("connect.php");
    $idsMM = array();
    foreach($ids as $id){
        $req1 = "SELECT ID FROM AVOIRPARDEFAUT WHERE ID_1=$id;";
        $result1 = mysql_query($req1)or die(mysql_error());
        while($res = mysql_fetch_array($result1)){
            array_push($idsMM, $res['ID']);
        }
    }
    echo json_encode($idsMM);
?>
