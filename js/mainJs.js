$(document).ready(function(){
    var tab = {'page':'','ajout':'','suppr':'','modif':'','dialogId':''};
    $(".tabs" ).tabs();
    reloadContent();
    updateTAb();
    updateSubmitClick(tab.modif);
    $('input#search').quicksearch('.ui-tabs-panel:visible table tbody tr');
    function reloadContent(){
        $(".tableau").tablesorter();
        $("input#submit, button").button();
        $(".dialog").dialog('destroy');
        $(".dialog").dialog({
            autoOpen: false,
            width: 'auto',
            modal: true,
            close: function(event, ui) {
                $(tab.dialogId+' form.formulaire').get(0).reset();
            }
        });
        
        $("#dialog-confirm").dialog({
            autoOpen: false,
            width: 'auto',
			modal: true,
			title: 'Suppression!'
		});
        
        $('.btAjout').click(function(){
            updateSubmitClick(tab.ajout);
            $(tab.dialogId+' form h1').html('AJOUT ' + $('ul .ui-state-active a').html());
            $(tab.dialogId).dialog('open');
        });
        
        $('img.modif').click(function(){
            if($('.dialog').dialog('isOpen')) return false;
            else{
                updateSubmitClick(tab.modif);
                var par = $(this).parent().parent();
                // Remplir les champs en fonction 
                $(tab.dialogId+' .formulaire input').each(function(){
                    $(this).val(getChildText(par,$(this).attr('id')));
                });
                $(tab.dialogId+' form h1').html('MODIFICATION ' + $('ul .ui-state-active a').html());
                $(tab.dialogId).dialog('open');
            }
        });
        
        $('img.suppr').click(function(){
            if($('.dialog').dialog('isOpen')) return false;
            else{
                var par = $(this).parent().parent();
                $("#dialog-confirm #confirmMess").html("Voulez-vous vraiment supprimer "+par.children(':nth-child(2)').text()+"?");
                $("#dialog-confirm").dialog("option","buttons",{"Supprimer":function(){
                                                                    submitForm('id='+getChildText(par,'id'),tab.suppr);
                                                                    $("#dialog-confirm").dialog('close');
                                                                },"Annuler":function(){
                                                                    $("#dialog-confirm").dialog('close');
                                                                }});
                $("#dialog-confirm").dialog('open');
            }
        });
        $('.parModifMM').click(function(){
            console.log('.parModifMM click');
            $('#dialogParMM').dialog('open');
            var idPar = $(this).parent().parent().children().first().text();
            updateSubmitClick('parModifMM.php','#dialogParMM button.submit', "'idPar="+idPar+"&ids=' + $('#dialogParMM input:checkbox:checked').map(function(){return $(this).val()}).get().join(',')");
            // tout décocher avant
            $('#dialogParMM input:checkbox').each(function(){
                $(this).attr('checked',false);
            });
            $(this).parent().parent().children(':nth-child(3)').children('select').children('option').each(function(){
                var idMM = $(this).val();
                $('#dialogParMM input:checkbox').each(function(){
                    if($(this).val() == idMM) $(this).attr('checked',true);
                });
            });
        });
    }
    
    function updateSubmitClick(php, cssButton, formData){
        console.log(formData);
        if(cssButton === undefined) cssButton = tab.dialogId+' button.submit';
        if(formData === undefined) formData = "$(tab.dialogId+' form.formulaire').first().serialize()";
        $(cssButton).unbind('click');
        $(cssButton).click(function(e){
            e.preventDefault();
            //		if(validateForm()){
            formData = eval(formData);
            submitForm(formData, php);
            $('.dialog').dialog('close');
            //}else{$('#Formulaire #response').removeClass().addClass('error').html('Remplissez le formulaire comme demand\351!').fadeIn('fast');}
        });
    }
    function updateTAb(){
        tab.page = $('.ui-tabs-panel:visible').attr('page');
        tab.ajout = $('.ui-tabs-panel:visible').attr('ajout');
        tab.suppr = $('.ui-tabs-panel:visible').attr('suppr');
        tab.modif = $('.ui-tabs-panel:visible').attr('modif');
        tab.dialogId = $('.ui-tabs-panel:visible').attr('dialogId');
    }
    // fonction changeant les variables de tabs
    $('ul.ui-tabs-nav a').click(function(){
        updateTAb();
        $('.ui-tabs-panel:visible').load(tab.page,function(){reloadContent();});
        $('input#search').quicksearch('.ui-tabs-panel:visible table tbody tr');
    });
    
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
                    $('.ui-tabs-panel:visible').load(tab.page,function(){reloadContent();});
                }
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert("D\351sol\351! Il y a eu une erreur: " + errorThrown + " " + textStatus+" Veuillez contacter Thibaud SMITH afin de résoudre ce problème!");
                
			}
		});
	}
	function displayMess(mess, Class, timeOut){
	    $('#message').html(mess).removeClass('ui-state-highlight ui-state-error').addClass(Class + ' ui-corner-all').fadeIn('slow');
	    setTimeout(function(){$('#message').fadeOut('slow');},timeOut);
	}
});
