<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script type="text/javascript" src="js/jquery-ui-1.8.18.custom/js/jquery-1.7.1.min.js"></script>
	<script>
	    $(document).ready(function(){
	        $.ajax({type:'POST',
					url:'sync.php',
					dataType:'json',
					success: function(data){
						console.log(data);
						for (var i in data){
							if (data[i].TYPE == 'A'){
								execModif(
							}
						}
					}
			});
			function execAjout(){
			
			}
	    })
	</script>
</head>
<body>
    <div id="page"></div>
</body>
</html>

