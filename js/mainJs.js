$(document).ready(function(){

    $(".tabs" ).tabs();
    reloadContent();
    function reloadContent(){
        $("#tableau").tablesorter();
        $("input#submit, button").button();
        $(".dialog").dialog({
            autoOpen: false,
            width: 'auto',
        });
        $('.btAjout').click(function(){
            $("#dialog").dialog('open');
        });
        $('img.modif').click(function(){
            if($('#dialog').dialog('isOpen')) return false;
            else{
                var par = $(this).parent().parent();
                $('.ui-tabs-panel:visible #dialog .formulaire > h1').html("Modification du client");
                $('.ui-tabs-panel:visible #dialog .formulaire > #nom').val(getChildText(par,'nom'));
                $('#dialog').dialog('open');
            }   
        });
        $('input#search').quicksearch('table tbody tr');    
        $('.myform .formulaire button.submit').click(function(e){
		    e.preventDefault();
    //		if(validateForm()){
    //			$('#Formulaire #response').removeClass().addClass('processing').html(loadingText).fadeIn('fast');
		    var formData = $('.myform form.formulaire').serialize();
		    var php = $(this).attr('id');
		    submitForm(formData, php);
		    $("#dialog").dialog('close');
		    $('.myform form.formulaire').get(0).reset();
    //		}else{
    //			$('#Formulaire #response').removeClass().addClass('error').html('Remplissez le formulaire comme demand\351!').fadeIn('fast');
    //		}
	    });
    }
    
	// retourne le contenue textuel d'un élément Enfant
	function getChildText(parentEl,id){
		return parentEl.children('td#'+id).text();
	}
	
	function submitForm(formData, URL){
		$.ajax({
			type: 'POST',
			url: URL,
			data: formData,
			dataType: 'json',
			cache: false,
			timeout: 7000,
			success: function(data) {
                if (data.error){
                    displayMess("<img src='img/error.png'/><h3>"+data.msg+"</h3>", "ui-state-error",2500);
                }else{
                    displayMess("<img src='img/icon_ok.png'/><h3>"+data.msg+"</h3>", "ui-state-highlight",2500);
                    $('.ui-tabs-panel:visible').load($('.ui-tabs-panel:visible').attr('page'),function(){reloadContent();});
                }
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert("D\351sol\351! Il y a eu une erreur" + errorThrown + " " + textStatus);
                
			}
		});
	}
	function displayMess(mess, Class, timeOut){
	    $('#message').html(mess).removeClass('ui-state-highlight ui-state-error').addClass(Class + ' ui-corner-all').fadeIn('slow');
	    setTimeout(function(){$('#message').fadeOut('slow');},timeOut);
	}
});
