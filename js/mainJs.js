function _init(){
    var tab = {'page':'','ajout':'','suppr':'','modif':'','dialogId':'','needReload':''};
    $(".tabs" ).tabs({'selected':5});
    reloadContent();
    updateTAb();
    updateSubmitClick(tab.modif);
    function reloadContent(){
        $(".datepicker" ).datepicker();
        $(".tableau").tablesorter();
        $("button").button();
        $(".combobox").combobox();
        $(".radio").buttonset();
        $(".dialog").dialog('destroy');
        $(".dialog").dialog({
            autoOpen: false,
            width: 'auto',
            modal: true,
            close: function(event, ui) {$(".datepicker" ).datepicker();
                if(tab.dialogId != '#CTRL') $(tab.dialogId+' form.formulaire').get(0).reset();
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
            var nom = $(this).parent().parent().children(":nth-child(2)").text();
            $('#dialogParMM').dialog({'title':'Moyens de mesure par défaut pour le paramètre: '+nom});
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
        
        // CTRL ajout Paramètre
        $('#dialogParCtr button.submit').click(function(){
            $.ajax({type:'POST',
                    url:'getListMM.php',
                    dataType:'json',
                    data:{'ids':$('#dialogParCtr input:checkbox:checked').map(function(){return $(this).val()}).get().join(',')},
                    success: function(data){
                        // Boucle sur les checkboxes des MM et pour chaque cb vérifie si son id a été renvoyé
                        $('#dialogMMCtr input:checkbox').each(function(){
                            $(this).attr('checked',false);
                            var idMM = $(this).val();
                            for (var i in data){
                                if(data[i]==idMM) $(this).attr('checked',true);
                            }
                        });
                        // Vide et rerempli les lists déroulantes
                        $('#CTRL select#Par option').remove();
                        $('#dialogParCtr input:checkbox:checked').each(function(){
                            $('#CTRL select#Par').append("<option>"+ $(this).parent().next().text() +"</option>");
                        });
                        $('#CTRL select#MM option').remove();
                        $('#dialogMMCtr input:checkbox:checked').each(function(){
                            $('#CTRL select#MM').append("<option>"+ $(this).parent().next().text() +"</option>");
                        });
                    }
            });
            $('#dialogParCtr').dialog('close');
        });
        
        // CTRL ajout Moyen de mesure
        $('#dialogMMCtr button.submit').click(function(){
            $('#CTRL select#MM option').remove();
            $('#dialogMMCtr input:checkbox:checked').each(function(){
                $('#CTRL select#MM').append("<option>"+ $(this).parent().next().text() +"</option>");
            });
            $('#dialogMMCtr').dialog('close');
        });
        
        // Affichage ajout Ctrl
    	$('#CTRL table tr:not(.menu)').hide();
	    $('#CTRL .menu.type .radio input:radio').change(function(){
	        var affichClass=$(this).attr('affichClass');
            $('#CTRL tr:not(.'+affichClass+')').hide();
	        $('#CTRL tr.'+affichClass).show();
	        $('#CTRL tr.static').show();
	    });
	    $('#CTRL tr.menu.lieu .radio input:radio').change(function(){
	        var lieu=($(this).attr('id'));
	        switch (lieu){
    	        case 'site':
        	        var num = $('#CTRL input#num').attr('defaut');
    	            $('#CTRL input#num').val(num);
    	            break;
    	        case 'atelier':
    	            $('#CTRL input#num').val('');
    	            break;
	        }
	    });
	    $('#ajoutParCtr').click(function(){
	        $('#dialogParCtr').dialog('open');
	        $('#dialogParCtr').dialog({'title':'Paramètres vérifiés:'});
	    });
	    $('#ajoutMMCtr').click(function(){
	        $('#dialogMMCtr').dialog('open');
	        $('#dialogMMCtr').dialog({'title':'Moyens de mesure employés:'});
	    });
	    
	    $('#AppMarq').change(function(){alert('event Triggered');});
    }

    
    function updateSubmitClick(php, cssButton, formData){
        if(cssButton === undefined) cssButton = tab.dialogId+' button.submit';
        if(formData === undefined) formData = "$(tab.dialogId+' form.formulaire').first().serialize()";
        $(cssButton).unbind('click');
        $(cssButton).click(function(e){
            e.preventDefault();
            // if(validateForm()){
            formData = eval(formData);
            submitForm(formData, php);
            $('.dialog').dialog('close');
            // }else{$('#Formulaire #response').removeClass().addClass('error').html('Remplissez le formulaire comme demand\351!').fadeIn('fast');}
        });
    }
    function updateTAb(){
        tab.page = $('.ui-tabs-panel:visible').attr('page');
        tab.ajout = $('.ui-tabs-panel:visible').attr('ajout');
        tab.suppr = $('.ui-tabs-panel:visible').attr('suppr');
        tab.modif = $('.ui-tabs-panel:visible').attr('modif');
        tab.dialogId = $('.ui-tabs-panel:visible').attr('dialogId');
        tab.needReload = $('.ui-tabs-panel:visible').attr('needReload');
    }
    // fonction changeant les variables de tabs
    $('ul.ui-tabs-nav a').click(function(){
        updateTAb();
        // Vérifier si la tab necessite d'etre rechargé
        if(tab.needReload == "true"){
            $('.ui-tabs-panel:visible').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");
            $('.ui-tabs-panel:visible').load(tab.page,function(){reloadContent();});
        }
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
	
	$.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: '&#x3c;Pr\351c',
		nextText: 'Suiv&#x3e;',
		currentText: 'Courant',
		monthNames: ['Janvier','F\351vrier','Mars','Avril','Mai','Juin',
		'Juillet','Ao\373t','Septembre','Octobre','Novembre','D\351cembre'],
		monthNamesShort: ['Jan','F\351v','Mar','Avr','Mai','Jun',
		'Jul','Ao\373','Sep','Oct','Nov','D\351c'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		weekHeader: 'Sm',
		dateFormat: 'dd-mm-yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	
//	$( "#remotecombobox" ).autocomplete({
//		source: "searchApp.php",
//		minLength: 2,
//		select: function( event, ui ) {
//			log( ui.item ?
//					"Selected: " + ui.item.value + " aka " + ui.item.id :
//					"Nothing selected, input was " + this.value );
//		}
//	});

	
}
//////////////    Initialisation des combobox autocomplete    ////////////////

(function( $ ) {
    function comboSelectDefault(select){
       if($(select + ' option').size() == 1) {
            $(select + ' option').attr("selected","selected");
            $(select).next().val($(select + ' option:selected').text());
        }
    }
	function comboboxSelect(ui, input){
	    console.log("ComboSelect :)");
	    var select = $(input).prev();
	    var option = escape(ui.item.value);
	    var id = select.attr('id');
	    switch (id){
	        case "AppDesi":
	            $('select#AppMarq').load("comboSearchApp.php?field=MARQUE&knownField=DESIGNATION&term="+option, 
	                                    function(){$('select#AppMarq').next().val("");comboSelectDefault('select#AppMarq');});
	            $('select#AppType').load("comboSearchApp.php?field=TYPE&knownField=DESIGNATION&term="+option, 
	                                    function(){$('select#AppType').next().val("");comboSelectDefault('select#AppType');});
	            break;
	            
	        case "AppMarq":
	            $('select#AppDesi').load("comboSearchApp.php?field=DESIGNATION&knownField=MARQUE&term="+option, 
                                        function(){$('select#AppDesi').next().val("");comboSelectDefault('select#AppDesi');});
	            $('select#AppType').load("comboSearchApp.php?field=TYPE&knownField=MARQUE&term="+option, 
	                                    function(){$('select#AppType').next().val("");comboSelectDefault('select#AppType');});
	            break;
	            
	        case "AppType":
	            $('select#AppDesi').load("comboSearchApp.php?field=DESIGNATION&knownField=TYPE&term="+option, 
	                                    function(){$('select#AppDesi').next().val("");comboSelectDefault('select#AppDesi');});
	            $('select#AppMarq').load("comboSearchApp.php?field=MARQUE&knownField=TYPE&term="+option, 
	                                    function(){$('select#AppMarq').next().val("");comboSelectDefault('select#AppMarq');});
	            break;
	    }
	}
	$.widget( "ui.combobox", {
		_create: function() {
			var self = this,
				select = this.element.hide(),
				selected = select.children( ":selected" ),
				value = selected.val() ? selected.text() : "";
			var input = this.input = $( "<input>" )
				.insertAfter( select )
				.val( value )
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: function( request, response ) {
						var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
						response( select.children( "option" ).map(function() {
							var text = $( this ).text();
							if ( this.value && ( !request.term || matcher.test(text) ) )
								return {
									label: text.replace(
										new RegExp(
											"(?![^&;]+;)(?!<[^<>]*)(" +
											$.ui.autocomplete.escapeRegex(request.term) +
											")(?![^<>]*>)(?![^&;]+;)", "gi"
										), "<strong>$1</strong>" ),
									value: text,
									option: this
								};
						}) );
					},
					select: function( event, ui ) {
						ui.item.option.selected = true;
						self._trigger( "selected", event, {
							item: ui.item.option
						});
						
						comboboxSelect(ui, this);
					},
					change: function( event, ui ) {
						if ( !ui.item ) {
							var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
								valid = false;
							select.children( "option" ).each(function() {
								if ( $( this ).text().match( matcher ) ) {
									this.selected = valid = true;
									return false;
								}
							});
							if ( !valid ) {
								// remove invalid value, as it didn't match anything
								$( this ).val( "" );
								select.val( "" );
								input.data( "autocomplete" ).term = "";
								return false;
							}
						}
					}
				})
				.addClass( "ui-widget ui-widget-content ui-corner-left" );

			input.data( "autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
			};

			this.button = $( "<button type='button'>&nbsp;</button>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.insertAfter( input )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "ui-corner-right ui-button-icon" )
				.click(function() {
					// close if already visible
					if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
						input.autocomplete( "close" );
						return;
					}

					// work around a bug (likely same cause as #5265)
					$( this ).blur();

					// pass empty string as value to search for, displaying all results
					input.autocomplete( "search", "" );
					input.focus();
				});
		},

		destroy: function() {
			this.input.remove();
			this.button.remove();
			this.element.show();
			$.Widget.prototype.destroy.call( this );
		}
	});
	
})( jQuery );
