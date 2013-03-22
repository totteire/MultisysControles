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
        bottom: 30px;
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
    $req = "SELECT LIBELLE, NOM_VERIF, NUM_DATE_VERIF FROM MOYEN_MESURE, UTILISER U WHERE U.ID_1 = MOYEN_MESURE.ID AND U.ID=$ctrlId ORDER BY MOYEN_MESURE.ORDRE";
    $resultMM = mysql_query($req) or die(mysql_error());
    
    $req = "SELECT LIBELLE, LABEL FROM PARAMETRE, VERIFIER V WHERE V.ID_1 = PARAMETRE.ID AND V.ID=$ctrlId";
    $resultPar = mysql_query($req) or die(mysql_error());
?>

<page orientation='portrait' format='A4' style='' <?php if($ilEnTete == 1) echo "backimg='./img/PAPIERENTETE.jpg'";?>>
    <div class='container' style=''>
        <div class='titre' style=''><h1 style='margin-bottom:5px;'><?php echo $titre;?></h1></div>
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
        <h2>¤ APPAREIL DE MESURE VERIFIÉ ¤</h2>
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
        <h2>¤ MOYENS DE VÉRIFICATION UTILISÉS ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Equipment used for assessment</div>
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
                <td><b>2 pages</b></td>
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
            <div style=''>
                - Ce document est réalisé suivant les recommandations des fascicules de documentation AFNOR X07-011 définissant le constat de vérification.<br><span class='trad' style='margin-left:5px'>This document is issued according to AFNOR X07-011 documentation section which define a calibration certificate.</span>
            </div>
        </div>
        <table class='small footer' cellspacing='0' style=''>
            <tr>
                <td style='width:33%;text-align:left;'>04/06/2012</td>
                <td style='width:30%;text-align:center;'><?php echo $titre?></td>
                <td style='width:33%;text-align:right;'>1/2</td>
            </tr>
        </table>
    </div>
</page>




<page orientation='portrait' format='A4' style='font-size: 12pt;' <?php if($EnTete == 1) echo "backimg='./img/PAPIERENTETE.jpg'";?>>
    <div class='container' style=''>
        <div class='titre' style=''><h1><?php echo $titre;?></h1></div>
        <div class='' style='width:100%;margin:auto;text-align:center;font-size:15px;font-style:italic;'>Calibration Certificate</div>
        <div class='numero' style=''><h1>N°<?php echo " ".$res['NUM'];?></h1></div>
        <h2>¤ MÉTHODE DE MESURES EMPLOYÉE ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Measuring method used</div>
        <div class='normale' style=''>Mesures effectuées par comparaison ou par injection avec les étalons de référence de l'entreprise raccordés COFRAC.</div>
        <div class='trad'>Measuring made by comparison or injection with the company's reference standards, linked COFRAC.</div>
        <h2>¤ CONDITIONS DE MESURES ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Measuring conditions</div>
	<div class='normale' style=''>Température: <b><?php if($res['TEMPERATURE'] == "") echo "23°+/-2";else echo $res['TEMPERATURE'];?>°C</b></div>
        <div class='trad'>Temperature</div>
        <h2>¤ LISTE DES PARAMÈTRES VÉRIFIÉS ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Audited parameters list</div>
        <table>
            <tr><td style='padding-right:100px;'>
            <table class='normale spaced' cellspacing='0'>
            <?php 
                $nbLignes=3;
                $nb=0;
                while($resPar = mysql_fetch_array($resultPar)){
                    echo "<tr><td>- ".$resPar['LIBELLE']."<br><span style='margin-Left:10px;' class='trad'>".$resPar['LABEL']."</span></td></tr>";
                    $nb++;
                    if($nb % $nbLignes == 0) echo "</table></td><td style='padding-right:50px;'><table class='normale spaced' cellspacing='0'>";
                }
            ?>
            </table></td></tr>
        </table>


        <h2>¤ JUGEMENT ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Operation assessment</div>
        <table class='normale' cellspacing='0' style=''>
	    <?php
		switch($res['JUGEMENT']){
		    case 1:
			echo "<tr><td>Appareil conforme aux spécifications énoncées par le constructeur.<br><span style='margin-left:20px' class='trad'>Device in compliance with the manufacturer's specifications.</span></td></tr>";
			break;
		    case 2:
			echo "<tr><td>Appareil conforme aux spécifications énoncées par l'utilisateur.<br><span style='margin-left:20px' class='trad'>Device in compliance with the user's specifications.</span></td></tr>";
			break;
		    case 3:
			echo "<tr><td>Appareil conforme aux spécifications énoncées par le technicien vérificateur.<br><span style='margin-left:20px' class='trad'>Device in compliance with the technician's specifications.</span></td></tr>";
			break;
		    case 4:
			echo "<tr><td>Appareil conforme aux spécifications énoncées par le constructeur après réparation.<br><span style='margin-left:20px' class='trad'>Device in compliance with the manufacturer's specifications after reparing.</span></td></tr>";
			break;
		    case 5:
			echo "<tr><td>Appareil conforme aux spécifications énoncées par l'utilisateur après réparation.<br><span style='margin-left:20px' class='trad'>Device in compliance with the user's specifications after reparing.</span></td></tr>";
			break;
		    case 6:
			echo "<tr><td>Appareil conforme aux spécifications énoncées par le technicien vérificateur après réparation.<br><span style='margin-left:20px' class='trad'>Device in compliance with the technician's specifications after reparing.</span></td></tr>";
			break;
		    case 7:
			echo "<tr><td>Appareil non conforme.<br><span style='margin-left:20px' class='trad'>Device not in compliance with the user's specifications.</span></td></tr>";
			break;
		}	

	    ?>
        </table>
        <h2>¤ OBSERVATIONS ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Observations</div>
        <div class='normale'><?php if($res['OBSERVATION'] == '')echo "NÉANT"; else echo nl2br($res['OBSERVATION']);?></div>
        <table class='small footer' cellspacing='0' style=''>
            <tr>
                <td style='width:33%;text-align:left;'>04/06/2012</td>
                <td style='width:30%;text-align:center;'><?php echo $titre?></td>
                <td style='width:33%;text-align:right;'>2/2</td>
            </tr>
        </table>
    </div>
</page>
