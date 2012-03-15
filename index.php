<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Gestion Constats</title>
	<link media="screen, projection, print" href="style.css" type="text/css" rel="stylesheet"/>
	<link type="text/css" href="./js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
	<script type="text/javascript" src="js/mainJs.js"></script>
</head>
<body>

    <div id="header">
    
    </div>
    
    <div id="page-content">
        
	    <div class="tabs">
	    <div id="message" class="ui-state-highlight ui-corner-all" style=""></div>
	        <ul>
		        <li><a href="#tabCli">CLIENT</a></li>
		        <li><a href="#tabApp">APPAREIL</a></li>
	        	<li><a href="#tabCtr">CONTROLE</a></li>
	        	<li><a href="#tabMes">MOYEN MESURE</a></li>
	        	<li><a href="#tabPar">PARAMETRES</a></li>
	        	<li style="margin-left:15px;top:8px;">Rechercher:</li>
	        	<li><input type="text" id="search" style="margin:0 0 0 5px;"/></li>
        	</ul>
	        <div id="tabCli" page='client.php'>
		        <?php include("client.php")?>
	        </div>
        	<div id="tabApp">
		        <?php include("appareil.php")?>
        	</div>
        	<div id="tabCtr">
		        <?php include("controle.php")?>
        	</div>
        	<div id="tabMes">
		        <?php include(".php")?>
        	</div>
        	<div id="tabPar">
		        <?php include(".php")?>
        	</div>
	    </div>
	</div>

</body>
</html>
