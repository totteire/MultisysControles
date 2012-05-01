$(document).ready(function(){
    $.ajax({type:'POST',
        url:'syncGetModif.php',
        dataType:'json',
        success: function(data){
            console.log(data);
            for (var i in data){
				execModif(data[i]);
            }
        }
    });
    function execModif(data){
        $.ajax({
            url:"http://88.191.153.53/MultisysControles/syncModif.php",
            dataType:'jsonp',
            data: data,
            jsonp:'callback',
            success: function(data){
                console.log(data);
            },
            erreur: function(XMLHttpRequest, textStatus, errorThrown){
                alert("D\351sol\351! Il y a eu une erreur: " + errorThrown + " " + textStatus+" Veuillez contacter Thibaud SMITH afin de résoudre ce problème!");
            }
        });
    }
})
