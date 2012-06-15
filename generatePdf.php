<?php

    $ctrlId = $_GET['id'];
    $EnTete = $_GET['bg'];
    
    include('connect.php');
    $req = "SELECT * FROM CONTROLE,CLIENT C,APPAREIL A, TECHNICIEN T WHERE C.ID=CONTROLE.ID_AVOIR AND A.ID=CONTROLE.ID_CONCERNER AND CONTROLE.TECHNICIEN=T.ID AND CONTROLE.ID=$ctrlId ORDER BY DATE DESC;";
    $result = mysql_query($req) or die(mysql_error());
    $res = mysql_fetch_array($result);
    
    switch($res['TYPE_CTRL']){
        case 'veri':
            $page = './ConstatDeVerification.php';
            $titre = 'CONSTAT DE VÉRIFICATION';
            break;
        case 'essa':
            $page = './ControleEssais.php';
            $titre = "ATTESTATION DE CONTRÔLE ET D'ESSAIS";
            break;
        case 'etal':
            $page = './CertificatEtalonnage.php';
            $titre = "CERTIFICAT D'ÉTALONNAGE";
            break;
    }
    $date = date("Y-m-d");
    $req = "UPDATE CONTROLE SET PDF_EDIT='$date' WHERE ID='$ctrlId';";
    $resUpdate = mysql_query($req) or die (mysql_error());
    
    ob_start();
    include($page);
    $content = ob_get_clean();

    require_once('./html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','fr');
    $pdf->WriteHTML($content);
    $pdf->Output($res['NUM'].'.pdf');
    
    
#    echo $content;
?>
