<style type='text/css'>
    .normale{
        font-size: 11pt;
    }
    .small{
        font-size: 7pt;
    }
    h2{
        font-style: italic;
        font-weight: bold;
        margin-top: 30px;
    }
    .footer{
        width:100%;
        position: absolute;
        bottom: 10px;
        height: 5px;
    }
    .container{
        margin: 0 10px 0 70px;
        height: 100%
    }
    table.spaced td{
        padding: 5px 5px;
    }
    table.MM td{
        padding: 2px 5px;
    }
    .titre{
        margin: auto;
        margin-top: 100px;
        margin-bottom: 0px;
        width: 100%;
        text-align: center;
    }
    .numero{
        margin:auto; 
        margin-bottom:20px; 
        width: 400px;
        text-align:center;
    }
    .fauxFooter{
        padding: 5px;
        width: 430px;
        margin-left: 85px;
        position: absolute;
        bottom: 40px;
        margin: auto;
        border: 1px solid black;
    }
    .trad{
        font-style: italic;
        font-size: 9px;
    }
    h2{
        margin-bottom:0 ;
    }
    
</style>

<?php
    $req = "SELECT LIBELLE, NOM_VERIF, NUM_DATE_VERIF FROM MOYEN_MESURE, UTILISER U WHERE U.ID_1 = MOYEN_MESURE.ID AND U.ID=$ctrlId";
    $resultMM = mysql_query($req) or die(mysql_error());
?>

<page orientation='portrait' format='A4' style='' <?php if($EnTete == 1) echo "backimg='./img/PAPIERENTETE.jpg'";?>>
    <div class='container' style=''>
        <div class='titre' style=''><h1><?php echo $titre;?></h1></div>
        <div class='' style='width:100%;margin:auto;text-align:center;font-size:15px;font-style:italic;'>Calibration Certificate</div>
        <div class='numero' style=''><h1>N°<?php echo " ".$res['NUM'];?></h1></div>

        <table class='normale' cellspacing='0' style='text-align: left;'>
            <tr>
                <td>Délivré à: </td>
                <td style='padding-left:15px;font-size:14pt;'><b><?php echo $res['NOM']?></b></td>
            </tr>
            <tr>
                <td class='trad'>Issued to: </td>
                <td style='padding-left:15px;'>
                    <?php 
            		    $ad=explode('$',$res["ADRESSE"]);
            		    echo $ad[0]."<br>";
            		    if (isset($ad[1]) && $ad[1]!='')echo $ad[1]."<br>";
            		    echo $res['AD_CP']." ".$res['AD_VILLE']."<br>";
                    ?>
                </td>
            </tr>
        </table>
        <h2>¤ APPAREIL DE MESURE VERIFIE ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Equipment identification</div>
	<table class='spaced' cellspacing='0' style='width:100%;'>
	    <tr>
		<td rowspan='2' style=''>Désignation:<br><span class='trad'>Description</span></td>
		<td rowspan='2' style='width:35%;padding-right:20px;'><b><?php echo $res['DESIGNATION']?></b></td>
		
		<td>Type:<br><span class='trad'>Model</span></td>
		<td style=''><b><?php echo $res['TYPE']?></b></td>
	    </tr>
	    <tr>
		
		<td>N° de série:<br><span class='trad'>Serial Number</span></td>
		<td style=''><b><?php echo $res['NUM_SERIE']?></b></td>
	    </tr>
	    <tr>
		<td>Constructeur:<br><span class='trad'>Manufacturer</span></td>
		<td><b><?php echo $res['MARQUE']?></b></td>
		<td>N° de Chassis:<br><span class='trad'>Customer n°</span></td>
		<td style=''><b><?php echo $res['NUM_CHASSIS']?></b></td>
	    </tr>
	</table>
        <h2>¤ MOYEN D'ÉTALONNAGE - RACCORDEMENT ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Calibration equipment - Connection</div>
        <table class='normale MM' cellspacing='0' style='width: 100%;'>
            <?php 
                while($resMM = mysql_fetch_array($resultMM)){
                    echo "<tr><td>".$resMM['LIBELLE']."</td><td></td><td>".$resMM['NOM_VERIF']." ".$resMM['NUM_DATE_VERIF']."</td></tr>";
                }
            ?>
        </table>
        <h2>¤ TECHNICIEN RESPONSABLE DE LA VÉRIFICATION ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Operator identification</div>
        <table class='normale spaced' cellspacing='0' style=''>
            <tr>
                <td>Nom :<br><span class='trad'>Name</span></td>
                <td><b><?php echo $res['TECH']?></b></td>
            </tr>
            <tr>
                <td style='padding-top:30px;'>Signature :<br><span class='trad'>Signature</span></td>
		<td><img <?php echo "src='".$res['SIGNATURE']."'"; ?> style="width:120px;height:54px;" \></td>
            </tr>
            <tr>
                <td>Ce constat comprend :<br><span class='trad'>This certificate includes</span></td>
                <td><b>1 page</b></td>
                <td style='padding-left:40px;'><b>Date de vérification : <?php echo date("d-m-Y",strtotime($res["DATE"]))?></b><br><span class='trad'>Verification date</span></td>
            </tr>
        </table>
        <div class='fauxFooter small'>
            <div style=''>
                - La reproduction de ce document n'est autorisée que sous forme de fac-similé photographique intégral.<br><span class='trad' style='margin-left:5px'>The reproduction of this certificate is only permitted through an integral facsimile</span>
            </div>
            <div style=''>
                - Ce document ne peut être utilisé en lieu et place d'un certificat d'étalonnage.<br><span class='trad' style='margin-left:5px'>This document cannot be used in place of a calibration certificate.</span>
            </div>
        </div>
        <table class='small footer' cellspacing='0' style=''>
            <tr>
                <td style='width:33%;text-align:left;'>16/07/2012</td>
                <td style='width:33%;text-align:center;'><?php echo $titre?></td> <td style='width:33%;text-align:right;'>1/1</td> </tr>
        </table>
    </div>
</page>
