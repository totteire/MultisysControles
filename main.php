<div id="header"></div>
<?php 
    header('Content-Type: text/html; charset=utf-8');
?>
<div id="page-content">
    <div class="tabs">
        <div id="message" class="ui-state-highlight ui-corner-all"></div>
        <div id="dialog-confirm">
            <p><span id='confirmIcon' class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><span id='confirmMess'></span></p>
        </div>
        <ul>
	        <li><a href="#tabCli">CLIENT</a></li>
	        <li><a href="#tabApp">APPAREIL</a></li>
        	<li><a href="#tabMes">MOYEN MESURE</a></li>
        	<li><a href="#tabPar">PARAMETRE</a></li>
        	<li><a href="#tabOpt">OPTION</a></li>
        	<li class="search" style="margin-left:15px;top:6px;">Rechercher:</li>
        	<li class="search"><input type="text" id="search" class="ui-corner-all" style="margin:0 0 0 5px;"/></li>
        	<li style="float:right;"><a href="#tabCtrl">AJOUT/MODIF DOCUMENT</a></li>
        	<li style="margin-right:30px;float:right;"><a href="#tabCtr">LISTE</a></li>
    	</ul>
        <div id="tabCli" class='tabMenu1' page='client.php' dialogId='#dialogCli' ajout='client/ajoutCli.php' suppr='client/supprCli.php' modif='client/modifCli.php' needReload='false'>
	        <?php 
	            include("client.php");
            ?>
        </div>
    	<div id="tabApp" class='tabMenu1' page='appareil.php' dialogId='#dialogApp' ajout='appareil/ajoutApp.php' suppr='appareil/supprApp.php' modif='appareil/modifApp.php' needReload='false'>
	        <?php 
	            include("appareil.php");
	        ?>
    	</div>
    	<div id="tabCtr" class='tabMenu2' page='controle.php' dialogId='' ajout='' suppr='controle/supprCtrl.php' modif='controle/modifCtrl.php' needReload='true'>
	        <?php
	            include("controle.php");
	        ?>
    	</div>
    	<div id="tabMes" class='tabMenu1' page='moyenMesure.php' dialogId='#dialogMes' ajout='moyenMesure/ajoutMes.php' suppr='moyenMesure/supprMes.php' modif='moyenMesure/modifMes.php' needReload='false'>
	        <?php 
	            include("moyenMesure.php");
	        ?>
    	</div>
    	<div id="tabPar" class='tabMenu1' page='parametre.php' dialogId='#dialogPar' ajout='parametre/ajoutPar.php' suppr='parametre/supprPar.php' modif='parametre/modifPar.php' needReload='true'>
	        <?php 
	            include("parametre.php");
	        ?>
    	</div>
    	<div id="tabOpt" class='tabMenu1' page='option.php' dialogId='#dialogOpt' ajout='technicien/ajoutTech.php' suppr='technicien/supprTech.php' modif='technicien/modifTech.php' needReload='true'>
	        <?php
	            include("option.php");
	        ?>
    	</div>
        <div id="tabCtrl" page='ctrl.php' dialogId='#CTRL' ajout='controle/ajoutCtrl.php' suppr='' modif='controle/modifCtrl.php' needReload='false'>
	        <?php
	            include("ctrl.php");
		?>
        </div>
    </div>
</div>
