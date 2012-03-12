<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Gestion Constats</title>
	<link media="screen, projection, print" href="style.css" type="text/css" rel="stylesheet"/>
<!--	<link href="css/style.css" type="text/css" rel="stylesheet"/>-->
	<link type="text/css" href="./js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/mainJs.js"></script>
</head>
<body>

    <div id="header">
    
    </div>
    
    <div id="page-content">
	    <div class="tabs">
	        <ul>
		        <li><a href="#tabs-1">CLIENT</a></li>
		        <li><a href="#tabs-2">APPAREIL</a></li>
	        	<li><a href="#tabs-3">CONTROLE</a></li>
        	</ul>
	        <div id="tabs-1">
		        <?php include("client.php")?>
	        </div>
        	<div id="tabs-2">
		        <?php include("appareil.php")?>
        	</div>
        	<div id="tabs-3">
		        <?php include("controle.php")?>
        	</div>
	    </div>
	</div>

</body>
</html>
