<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=ISO-8859-1" http-equiv="Content-Type">
	<title>Gestion Constats</title>
	<link media="screen, projection, print" href="css/style.css" type="text/css" rel="stylesheet"/>
	<link type="text/css" href="./js/jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
	<script type="text/javascript" src="js/mainJs.js"></script>
	<script>
	    $(document).ready(function(){
	        $('#page').load('main.php', function(){_init();$('#loader').fadeOut('slow');})
	    })
	</script>
</head>
<body>
    <div id="loader" style="width:100%;height:100%;background-color:black"><div style="width:300px;height:300px;margin:auto;"><img src="img/loading.gif" /></div></div>
    <div id="page"></div>
</body>

</html>

