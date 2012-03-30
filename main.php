<div id="header"></div>

<div id="page-content">
    <div class="tabs">
        <div id="message" class="ui-state-highlight ui-corner-all"></div>
        <div id="dialog-confirm">
            <p><span id='confirmIcon' class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><span id='confirmMess'></span></p>
        </div>
        <ul>
	        <li><a href="#tabCli">CLIENT</a></li>
	        <li><a href="#tabApp">APPAREIL</a></li>
        	<li><a href="#tabCtr">CONTROLE</a></li>
        	<li><a href="#tabMes">MOYEN MESURE</a></li>
        	<li><a href="#tabPar">PARAMETRE</a></li>
        	<li style="margin-left:15px;top:6px;">Rechercher:</li>
        	<li><input type="text" id="search" class="ui-corner-all" style="margin:0 0 0 5px;"/></li>
        	<li style="float:right;"><a href="#tabCtrl">+CONTROLE</a></li>
    	</ul>
        <div id="tabCli" page='client.php' dialogId='#dialogCli' ajout='client/ajoutCli.php' suppr='client/supprCli.php' modif='client/modifCli.php' needReload='false'>
	        <?php 
	            include("client.php");
            ?>
        </div>
    	<div id="tabApp" page='appareil.php' dialogId='#dialogApp' ajout='appareil/ajoutApp.php' suppr='appareil/supprApp.php' modif='appareil/modifApp.php' needReload='false'>
	        <?php 
	            include("appareil.php");
	        ?>
    	</div>
    	<div id="tabCtr">
	        <?php
	            include("controle.php");
	        ?>
    	</div>
    	<div id="tabMes" page='moyenMesure.php' dialogId='#dialogMes' ajout='moyenMesure/ajoutMes.php' suppr='moyenMesure/supprMes.php' modif='moyenMesure/modifMes.php' needReload='false'>
	        <?php 
	            include("moyenMesure.php");
	        ?>
    	</div>
    	<div id="tabPar" page='parametre.php' dialogId='#dialogPar' ajout='parametre/ajoutPar.php' suppr='parametre/supprPar.php' modif='parametre/modifPar.php' needReload='true'>
	        <?php 
	            include("parametre.php");
	        ?>
    	</div>
        <div id="tabCtrl" page='ctrl.php' dialogId='#CTRL' ajout='client/ajoutCli.php' suppr='controle/supprCtr.php' modif='controle/modifCtr.php' needReload='true'>
	        <?php
	            include("ctrl.php");
            ?>
        </div>
    </div>
</div>