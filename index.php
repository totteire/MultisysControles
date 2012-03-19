<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Gestion Constats</title>
	<link media="screen, projection, print" href="css/style.css" type="text/css" rel="stylesheet"/>
	<link type="text/css" href="./js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
	<script type="text/javascript" src="js/mainJs.js"></script>
</head>
<body>
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
	        	<li style="margin-left:15px;top:8px;">Rechercher:</li>
	        	<li><input type="text" id="search" style="margin:0 0 0 5px;"/></li>
        	</ul>
	        <div id="tabCli" page='client.php' dialogId='#dialogCli' ajout='client/ajoutCli.php' suppr='client/supprCli.php' modif='client/modifCli.php'>
		        <?php 
		            include("client.php");
	            ?>
	        </div>
        	<div id="tabApp" page='appareil.php' dialogId='#dialogApp' ajout='appareil/ajoutApp.php' suppr='appareil/supprApp.php' modif='appareil/modifApp.php'>
		        <?php 
		            include("appareil.php");
		        ?>
        	</div>
        	<div id="tabCtr">
		        <?php
		            include("controle.php");
		        ?>
        	</div>
        	<div id="tabMes" page='moyenMesure.php' dialogId='#dialogMes' ajout='moyenMesure/ajoutMes.php' suppr='moyenMesure/supprMes.php' modif='moyenMesure/modifMes.php'>
		        <?php 
		            include("moyenMesure.php");
		        ?>
        	</div>
        	<div id="tabPar" page='parametre.php' dialogId='#dialogPar' ajout='parametre/ajoutPar.php' suppr='parametre/supprPar.php' modif='parametre/modifPar.php'>
		        <?php 
		            include("parametre.php");
		        ?>
        	</div>
	    </div>
	</div>
</body>
</html>
