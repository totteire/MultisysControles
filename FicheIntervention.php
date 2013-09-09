<style type='text/css'>

    .normale{
        font-size: 11pt;
    }
    .small{
        font-size: 7pt;
    }
    h1{
	margin-bottom: 0;
    }
    h2{
        font-style: italic;
        font-weight: bold;
        margin-top: 30px;
        margin-bottom:0 ;
    }
    h3{
	margin-bottom: 0;
    }
    .footer{
        width:100%;
        position: absolute;
        bottom: 10px;
        height: 5px;
    }
    .container{
        margin: 0 10px 0 100px;
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
        margin-top: 200px;
        margin-bottom: 0px;
        width: 100%;
        text-align: center;
    }
    .center{
	margin: auto;
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
    
</style>
<page orientation='portrait' format='A4' style='' <?php if($EnTete == 1)echo "backimg='./img/PAPIERENTETE.jpg'";?>>
    <div class='container' style=''>
        <div class='titre' style=''><h1><?php echo $titre;?></h1></div>
        <div class='' style='width:100%;margin:0 auto;text-align:center;font-size:15px;font-style:italic;'>Intervention Sheet</div>
        <div class='numero' style=''><h1>N°<?php echo " ".$res['NUM'];?></h1></div>

        <!--<div class='' style="margin-top: 50px;">Toulouse, le <?php //setlocale(LC_TIME, 'fr_FR.utf8');$date = $res['DATE'];echo strftime("%d %B %Y",strtotime("$date"));?></div>-->
        <div class='' style="margin-top: 50px;">Toulouse, le <?php setlocale(LC_ALL, 'fr-FR.utf8','fra');$date = $res['DATE'];echo strftime("%d %B %Y",strtotime("$date"));?></div>
        <table class='normale' cellspacing='0' style='text-align: left; margin-top:50px;'>
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
        
        <h2 style="margin-top: 50px;">¤ APPAREIL DE MESURE VERIFIE ¤</h2>
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

        <h2 style="margin-top: 50px;">¤ RESULTATS ¤</h2>
        <div class='trad' style='margin-left:20px;margin-bottom:15px;'>Results</div>
	<div class='resultats' style=""><?php echo "RESULTAT SUIVANT ".$res['DOCST']." N° ".$res['DOCNUM']." CI-JOINT."; ?></div>

        <table class='small footer' cellspacing='0' style=''>
            <tr>
                <td style='width:33%;text-align:left;'>04/06/2012</td>
                <td style='width:30%;text-align:center;'><?php echo $titre?></td>
                <td style='width:33%;text-align:right;'>1/1</td>
            </tr>
        </table>
    </div>
</page>
