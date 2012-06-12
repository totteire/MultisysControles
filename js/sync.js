$(document).ready(function(){
    
    $.ajax({type:'POST',
        url:'sync.php',
        dataType:'json',
        success: function(data){
            console.log(data);
            for (var i in data){
	            if (data[i].TYPE == 'A'){
		            execAjout(data[i]);
	            }
            }
        }
    });
    function execAjout(data){
    // var sentdata = 'id=&nom='+data.NOM+'&ad1='+data.ADRESSE+'&adVille='+data.AD_VILLE+'&adCP='+data.AD_CP;
    //				var occur = "";
    //				for (var i in data){
    //				    occur = occur + data[i];
    //				}
    //				console.log(occur);
        $.ajax({
            url:"http://88.191.153.53/test.php",
            dataType:'jsonp',
            data: data,
            jsonp:'callback',
            // jsonpCallback: 'jsonpcallback'
            success: function(data){
                console.log(data);
            }
            // erreur: function(XMLHttpRequest, textStatus, errorThrown){
                // alert("D\351sol\351! Il y a eu une erreur: " + errorThrown + " " + textStatus+" Veuillez contacter Thibaud SMITH afin de résoudre ce problème!");

            // }
        });
    }
    // function jsonpcallback(data) { 
    // console.log(data);
    // if (data.error){
        // displayMess("<img src='img/error.png'/><h3>"+data.msg+"</h3>", "ui-state-error",2500);
    // }else{
        // displayMess("<img src='img/icon_ok.png'/><h3>"+data.msg+"</h3>", "ui-state-highlight",2500);
        // $('.ui-tabs-panel:visible').load(tab.page,function(){reloadContent();});
    // }

    // }


})
