<style type='text/css'>
    .normale{
        font-size: 11pt;
    }
    .small{
        font-size: 6pt;
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
        margin-bottom: 10px;
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
        position: absolute;
        bottom: 70px;
    }
    
</style>

<?php
    $req = "SELECT LIBELLE, NOM_VERIF, NUM_DATE_VERIF FROM MOYEN_MESURE, UTILISER U WHERE U.ID_1 = MOYEN_MESURE.ID AND U.ID=$ctrlId";
    $resultMM = mysql_query($req) or die(mysql_error());
    
    $req = "SELECT LIBELLE FROM PARAMETRE, VERIFIER V WHERE V.ID_1 = PARAMETRE.ID AND V.ID=$ctrlId";
    $resultPar = mysql_query($req) or die(mysql_error());
?>

<page orientation='portrait' format='A4' style='' <?php if($EnTete == 1) echo "backimg='./img/PAPIERENTETE.jpg'";?>>
    <div class='container' style=''>
        <div class='titre' style=''><h1><?php echo $titre;?></h1></div>
        <div class='numero' style=''><h1>N°<?php echo " ".$res['NUM'];?></h1></div>

        <table class='normale' cellspacing='0' style='text-align: left;'>
            <tr>
                <td>Délivré à: </td>
                <td style='padding-left:15px;'><b><?php echo $res['NOM']?></b></td>
            </tr>
            <tr>
                <td></td>
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
        <table cellspacing='0' style='width: 100%;'>
        <tr>
            <td style='width:40%'>
                <table class='normale spaced' cellspacing='0' style='text-align: left; float: left;display: inline;'>
                    <tr style=''>
                        <td style=''>Désignation:</td>
                        <td style=''><b><?php echo $res['DESIGNATION']?></b></td>
                    </tr>
                    <tr style=>
                        <td style=''>Constructeur:</td>
                        <td style=''><b><?php echo $res['MARQUE']?></b></td>
                    </tr>
                </table>
            </td><td style='width:40%'>
                <table class='normale spaced' cellspacing='0' style='display: inline;text-align: left;'>
                    <tr style=''>
                        <td>Type:</td>
                        <td style=''><b><?php echo $res['TYPE']?></b></td>
                    </tr>
                    <tr style=''>
                        <td>N° de série:</td>
                        <td style=''><b><?php echo $res['NUM_SERIE']?></b></td>
                    </tr>
                    <tr style=''>
                        <td>N° de Chassis:</td>
                        <td style=''><b><?php echo $res['NUM_CHASSIS']?></b></td>
                    </tr>
                </table>
            </td>
        </tr>
        </table>
        <h2>¤ MOYENS DE VÉRIFICATION UTILISÉS ¤</h2>
        <table class='normale MM' cellspacing='0' style='width: 100%;'>
            <?php 
                while($resMM = mysql_fetch_array($resultMM)){
                    echo "<tr><td>".$resMM['LIBELLE']."</td><td></td><td>".$resMM['NOM_VERIF']." ".$resMM['NUM_DATE_VERIF']."</td></tr>";
                }
            ?>
        </table>
        <h2>¤ TECHNICIEN RESPONSABLE DE LA VÉRIFICATION ¤</h2>
        <table class='normale spaced' cellspacing='0' style=''>
            <tr>
                <td>Nom :</td>
                <td><b><?php echo $res['TECH']?></b></td>
            </tr>
            <tr>
                <td>Signature :</td>
                <td></td>
            </tr>
            <tr>
                <td>Ce constat comprend :</td>
                <td><b>2 pages</b></td>
                <td style='padding-left:40px;'><b>Date de vérification : <?php echo date("d-m-Y",strtotime($res["DATE"]))?></b></td>
            </tr>
        </table>
        <div class='fauxFooter'>
            <div class='small' style='width:350px;margin:auto;text-align:center;'>
                La reproduction de ce document n'est autorisée que sous forme de fac-similé photographique intégral.
            </div>
            <div class='small' style='margin-top: 15px;'>
                1-Ce document ne peut être utilisé en lieu et place d'un certificat d'étalonnage.<br>
                2-Ce document est réalisé conformément à la norme NF X07-011 définissant les constats de vérification et selon l'instruction interne MULTISYS.
            </div>
        </div>
        <table class='small footer' cellspacing='0' style=''>
            <tr>
                <td style='width:33%;text-align:left;'>29/06/2011</td>
                <td style='width:33%;text-align:center;'><?php echo $titre?></td>
                <td style='width:33%;text-align:right;'>1/2</td>
            </tr>
        </table>
    </div>
</page>




<page orientation='portrait' format='A4' style='font-size: 12pt;' <?php if($EnTete == 1) echo "backimg='./img/PAPIERENTETE.jpg'";?>>
    <div class='container' style=''>
        <div class='titre' style=''><h1><?php echo $titre;?></h1></div>
        <div class='numero' style=''><h1>N°<?php echo " ".$res['NUM'];?></h1></div>
        <h2>¤ MÉTHODE DE MESURES EMPLOYÉE ¤</h2>
        <p class='normale' style=''>Mesures effectuées par comparaison ou par injection avec les étalons de référence de l'entreprise raccordés COFRAC.</p>
        <h2>¤ CONDITIONS DE MESURES ¤</h2>
        <p class='normale' style=''>Température: <b>23°+/-2°C</b></p>
        <h2>¤ LISTE DES PARAMÈTRES VÉRIFIÉS ¤</h2>
        <table class='normale spaced' cellspacing='0' style='width:100%'>
            <?php 
                while($resPar = mysql_fetch_array($resultPar)){
                    echo "<tr><td>- ".$resPar['LIBELLE']."</td></tr>";
                }
            ?>
        </table>
        <h2>¤ JUGEMENT ¤</h2>
        <table class='normale' cellspacing='0' style=''>
            <tr><td>(<?php if($res['JUGEMENT'] == 1) echo "X"; else echo "&nbsp;&nbsp;";?>) Appareil conforme aux spécifications énoncées par le constructeur pour les gammes vérifiées.</td></tr>
            <tr><td>(<?php if($res['JUGEMENT'] == 2) echo "X"; else echo "&nbsp;&nbsp;";?>) Appareil conforme aux spécifications énoncées par le constructeur après réparation.</td></tr>
            <tr><td>(<?php if($res['JUGEMENT'] == 3) echo "X"; else echo "&nbsp;&nbsp;";?>) Appareil non conforme.</td></tr>
        </table>
        <h2>¤ OBSERVATION ¤</h2>
        <p class='normale'><?php if($res['OBSERVATION'] == '')echo "NÉANT"; else echo $res['OBSERVATION'];?></p>
        <table class='small footer' cellspacing='0' style=''>
            <tr>
                <td style='width:33%;text-align:left;'>29/06/2011</td>
                <td style='width:33%;text-align:center;'><?php echo $titre?></td>
                <td style='width:33%;text-align:right;'>2/2</td>
            </tr>
        </table>
    </div>
</page>
