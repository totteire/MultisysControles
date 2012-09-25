<?php

    $ctrlId = $_GET['id'];
    if(isset($_GET['bg'])) $EnTete = $_GET['bg']; else $EnTete = 0;
    
    include('connect.php');
    $req = "SELECT * FROM CONTROLE,CLIENT C,APP_DESI AD, APP_MARQUE AM, APP_TYPE AT, TECHNICIEN T WHERE C.ID=CONTROLE.ID_AVOIR AND AD.ID=CONTROLE.ID_APP_DESI AND AM.ID=CONTROLE.ID_APP_MARQUE AND AT.ID=CONTROLE.ID_APP_TYPE AND CONTROLE.TECHNICIEN=T.ID AND CONTROLE.ID=$ctrlId ORDER BY DATE DESC;";
    $result = mysql_query($req) or die(mysql_error());
    $res = mysql_fetch_array($result);
    
    switch($res['TYPE_CTRL']){
        case 'CV':
            $page = './ConstatDeVerification.php';
            $titre = 'CONSTAT DE VÉRIFICATION';
            break;
        case 'ACE':
            $page = './ControleEssais.php';
            $titre = "ATTESTATION DE CONTRÔLE ET D'ESSAIS";
            break;
        case 'CE':
            $page = './CertificatEtalonnage.php';
            $titre = "CERTIFICAT D'ÉTALONNAGE";
            break;
	case 'FI':
	    $page = './FicheIntervention.php';
	    $titre = "FICHE D'INTERVENTION";
	    break;
    }
    if($res['TECHNICIEN'] == '1' && $res['TYPE_CTRL'] <> 'FI') die("<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>Le Technicien n'est pas renseigné, le ".$titre." n'est donc pas validé!"); 
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
    
#     echo $content;
?>
