prerempli = false;
// Permet de recharger CTRL la première fois lorsqu'on click sur l'onglet
CTRL_Ready = false;


function getFormatedDate(){
    var today = new Date();
    var month = today.getMonth() + 1;
    if(month < 10) month = "0" + month.toString();
    today = today.getDate()  + '-' + month + '-' + today.getFullYear();
    return today;
}
function _init(tabNum){
    if(tabNum === undefined) tabNum = 6;
    var tab = {'page':'','ajout':'','suppr':'','modif':'','dialogId':'','needReload':''};
    $(".tabs").tabs({'selected':tabNum});
    updateTAb();
    refreshTabClick();
    reloadContent();
    $(".tabs div[needReload=false] .tableau").tablesorter();    
    function reloadContent(){
	menuEdit = {'Editer':function(menuItem,menu) {
			    console.log(tab.page);
			    if(tab.page == "controle.php"){
				updateSubmitClick(tab.modif,'#CTRL .submit');
				$(".tabs").tabs({'selected':5});
				updateTAb();
				$('#tabCtrl').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");
				var id = getChildText($(this).parent(),'id');
				$('#tabCtrl').load('ctrlModif.php',{'ID':id},function(){reloadContent();refreshCtrlTable();CTRL_UpdateSubmitClick(tab.modif);console.log('tab.modif: '+tab.modif);});
			    }else{
				if($('.dialog').dialog('isOpen')) return false;
				else{
				    updateSubmitClick(tab.modif);
				    var par = $(this).parent();
				    // Remplir les champs en fonction 
				    $(tab.dialogId+' .formulaire input').each(function(){
					$(this).val(getChildText(par,$(this).attr('id')));
				    });
				    $(tab.dialogId+' form h1').html('MODIFICATION ' + $('ul .ui-state-active a').html());
				    $(tab.dialogId).dialog('open');
				}
			    }
		    }
	};
	menuDupliquer = {'Dupliquer':function(menuItem,menu) { 
		    var id = $(this).parent().children().first().text();
		    $(".tabs").tabs({'selected':5});
		    $('#tabCtrl').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");
		    $('#tabCtrl').load('ctrlModif.php',{'ID':id},function(){
			$('#CTRL button.submit').text("Dupliquer");
			reloadContent(); refreshCtrlTable();
			CTRL_UpdateSubmitClick(tab.ajout);
			$('#CTRL h2').text("Duplication de document");
			$('#CTRL #num').val('');
			$('#CTRL #date').val(getFormatedDate());
			$('#CTRL #date').change()
			$('#numS').val('');
			$('#numC').val('');	
			$('#technicien').children("option:selected").removeAttr("selected");
			$('#technicien').children("option").first().attr("selected","selected");
			$('#technicien').next().val('');
			$('#jugement').children("option:selected").removeAttr("selected");
			$('#jugement').children("option").first().attr("selected","selected");
			$('#jugement').next().val('');
			$('#observation').val('');
		    });
	    }
	};
	menuSuppr = {'Supprimer':function(menuItem,menu) { 
			if($('.dialog').dialog('isOpen')) return false;
			else{
			    var par = $(this).parent();
			    $("#dialog-confirm #confirmMess").html("Voulez-vous vraiment supprimer "+par.children(':nth-child(2)').text()+"?");
			    $("#dialog-confirm").dialog("option","title","Suppression!");
			    $("#dialog-confirm").dialog(
				"option",
				"buttons",{
				    "Supprimer":function(){
					submitForm('id='+getChildText(par,'id'),tab.suppr);
					$("#dialog-confirm").dialog('close');
				    },
				    "Annuler":function(){
					$("#dialog-confirm").dialog('close');
				    }
				}
			    );
			    $("#dialog-confirm").dialog('open');
			}
		}
	};
	menu1 = [
	    menuEdit,
	    menuSuppr
	];
	menu2 = [
	    menuDupliquer,
	    menuEdit,
	    menuSuppr
	];
	$(".tabMenu2 table.tableau tr td:not('.modifCell')").contextMenu(menu2,{theme:'human'});
	$('.tabMenu1 table.tableau tr td').contextMenu(menu1,{theme:'human'});
//        $.ajax({type:'POST',
//                url:'getApps.php',
//                dataType:'json',
//                success: function(data){
//                   console.log(data);
//                }
//        
//        });
        if(tab.page == "appareil.php") {$(".subtabs").tabs();refreshTabClick();}
        $(".datepicker").datepicker();
        $(".ui-tabs-panel:visible .tableau").tablesorter();
        $("button, a.button").button();
        $(".combobox").combobox();
        $(".radio").buttonset();
        $('input#search').quicksearch('.ui-tabs-panel:visible table.tableau tbody tr');
        $(".dialog").dialog('destroy');
        $(".dialog").dialog({
            autoOpen: false,
            width: 'auto',
            modal: true,
            close: function(event, ui) {
                if(tab.dialogId != '#CTRL') $(tab.dialogId+' form.formulaire').get(0).reset();
            }
        });
       
        $("#dialog-confirm").dialog({
            autoOpen: false,
	    width: 'auto',
	    modal: true
	});
        
        $('.btAjout').click(function(){
            updateSubmitClick(tab.ajout);
            $(tab.dialogId+' form h1').html('AJOUT ' + $('ul .ui-state-active a').html());
            $(tab.dialogId).dialog('open');
        });
        
	/*$('img.modif').click(function(){*/
	/*if($('.dialog').dialog('isOpen')) return false;*/
	/*else{*/
	/*updateSubmitClick(tab.modif);*/
	/*var par = $(this).parent().parent();*/
	/*// Remplir les champs en fonction */
	/*$(tab.dialogId+' .formulaire input').each(function(){*/
	/*$(this).val(getChildText(par,$(this).attr('id')));*/
	/*});*/
	/*$(tab.dialogId+' form h1').html('MODIFICATION ' + $('ul .ui-state-active a').html());*/
	/*$(tab.dialogId).dialog('open');*/
	/*}*/
	/*});*/
        
	/*$('img.modifCtrl').click(function(){*/
	/*updateSubmitClick(tab.modif,'#CTRL .submit');*/
	/*$(".tabs").tabs({'selected':5});*/
	/*updateTAb();*/
	/*$('#tabCtrl').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");*/
	/*var id = getChildText($(this).parent().parent(),'id');*/
	/*$('#tabCtrl').load('ctrlModif.php',{'ID':id},function(){reloadContent();refreshCtrlTable();CTRL_UpdateSubmitClick(tab.modif);console.log('tab.modif: '+tab.modif);});*/
	/*});*/

	/*$('#CTRL button.dupliquer').click(function(){*/
	/*var id=$("#CTRL input[name='id']").val();*/
	/*$('#tabCtrl').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");*/
	/*$('#tabCtrl').load('ctrlModif.php',{'ID':id},function(){*/
	/*reloadContent(); refreshCtrlTable();*/
	/*CTRL_UpdateSubmitClick(tab.ajout);*/
	/*$('#CTRL h2').text("Duplication de document");*/
	/*$('#CTRL button.submit').text("Dupliquer");*/
	/*$('#CTRL #num').val('');*/
	/*$('#CTRL #date').val(getFormatedDate());*/
	/*$('#CTRL #date').change()*/
	/*$('#numS').val('');*/
	/*$('#numC').val('');	*/
	/*$('#technicien').children("option:selected").removeAttr("selected");*/
	/*$('#technicien').children("option").first().attr("selected","selected");*/
	/*$('#technicien').next().val('');*/
	/*$('#jugement').children("option:selected").removeAttr("selected");*/
	/*$('#jugement').children("option").first().attr("selected","selected");*/
	/*$('#jugement').next().val('');*/
	/*$('#observation').val('');*/
	/*});*/
	/*});*/
        // REGROUPE INSTRUCTIONS CTRL POUR OPTIMISATION
	if(tab.page == "ctrl.php"){
	    CTRL_Ready = true;
	    CTRL_UpdateSubmitClick(tab.ajout); 
	    $('#CTRL #date').change(function(){
                if($('.menu.lieu .radio input:radio:checked').val() == 'S'){
		    $.ajax({type:'GET',
			    url:'getCtrlNum.php',
			    dataType:'html',
			    data:{'date':$('#ctrl #date').val()},
			    success: function(data){
				$('#ctrl #num').val(data);
			    }
		    });
		}
	    });
	    
	    $('button.ValidateNums').click(function(){
		var numS,numC;
		($('input#numS').val() == "")? numS = '****' : numS = $('input#numS').val(); 
		($('input#numC').val() == "")? numC = '****' : numC = $('input#numC').val();
                $("#dialog-confirm #confirmMess").html("<h2><p style='color:orange;'>Vérifiez si les numéros sont corrects!</p><br>Numéro de Série: </h2><h1 style='color:red;'>"+numS+"</h1><h2><br>Numéro de Chassis: </h2><h1 style='color:red;'>"+numC+"</h1>");
                $("#dialog-confirm").dialog("option","title","Attention!");
                $("#dialog-confirm").dialog(
                    "option",
                    "buttons",{
			"OK":function(){
			    $('input.toValidate').addClass('validated');
			    $('button.ValidateNums').fadeOut('slow');
			    $("#dialog-confirm").dialog('close');
			}
		    }
                );
		$("#dialog-confirm").dialog("option", "minWidth", 600);
                $("#dialog-confirm").dialog('open');
		return false;
	    });

	    if($('#CTRL').hasClass('modifCtrl')){
		prerempli = ($('#technicien option:selected').text() == "")? true:false;
		numSC_Change();
	    }

            // CTRL ajout Paramètre
            
            // Fonction appellé du callback ajax
            function fillSelelctParCtr(){
                var ParNbChecked = 0;
                $('#CTRL select#Par option').remove();
                $('#dialogParCtr input:checkbox:checked').each(function(){
                    ParNbChecked = ParNbChecked + 1;
			$('#CTRL select#Par').append("<option>"+ $(this).parent().next().text() +"</option>");
			$(this).parent().next().css('color','#EB8F00');
                });
                $('#CTRL select#Par').next().val(ParNbChecked+" selection"+((ParNbChecked>1)? "s":""));
            }
            
            $('#dialogParCtr button.submit').click(function(){
                
                if($('#CTRL').hasClass('ajoutCtrl')){
                    $.ajax({type:'POST',
                            url:'getListMM.php',
                            dataType:'json',
                            data:{'ids':$('#dialogParCtr input:checkbox:checked').map(function(){return $(this).val()}).get().join(',')},
                            success: function(data){
                                // Boucle sur les checkboxes des MM et pour chaque cb vérifie si son id a été renvoyé, si oui alors la cocher
                                var MMnbChecked = 0;
                                console.log(data);
                                $('#dialogMMCtr input:checkbox').each(function(){
    //                                $(this).attr('checked',false);
                                    var idMM = $(this).val();
                                    for (var i in data){
                                        if(data[i]==idMM){
                                            $(this).attr('checked',true);
                                        }
                                    }
                                });
                                // Vide et rerempli les lists déroulantes
                                fillSelelctParCtr();
                                
                                $('#CTRL select#MM option').remove();
                                $('#dialogMMCtr input:checkbox:checked').each(function(){
				    MMnbChecked = MMnbChecked + 1;
				    $('#CTRL select#MM').append("<option>"+ $(this).parent().next().text() +"</option>");
				    $(this).parent().next().css('color','#EB8F00');
                                });
                                $('#CTRL select#MM').next().val(MMnbChecked+" selection"+((MMnbChecked>1)? "s":""));
                            }
                    });
                }else{
                    console.log('modif');
                    fillSelelctParCtr();
                }
                
                $('#dialogParCtr').dialog('close');
            });
            
            // CTRL ajout Moyen de mesure
            $('#dialogMMCtr button.submit').click(function(){
                $('#CTRL select#MM option').remove();
                var MMnbChecked = 0;
                $('#dialogMMCtr input:checkbox:checked').each(function(){
                    MMnbChecked = MMnbChecked + 1;
		    $('#CTRL select#MM').append("<option>"+ $(this).parent().next().text() +"</option>");
		    $(this).parent().next().css('color','#EB8F00');
                });
                $('#CTRL select#MM').next().val(MMnbChecked+" selection"+((MMnbChecked>1)? "s":""));
                $('#dialogMMCtr').dialog('close');
            });
            // Affichage ajout Ctrl
	    $('#CTRL table tr:not(.menu)').hide();
	    $('#CTRL .menu.type .radio input:radio').change(function(){
		var affichClass=$(this).val();
		console.log(affichClass);
		if(!$('tr.lieu').is(':visible')) $('tr.lieu').show();
		$('#CTRL tr:not(.'+affichClass+')').hide();
		$('#CTRL tr.'+affichClass).show();
		$('#CTRL tr.static').show();
		if(affichClass == 'CE')
		    $('#CTRL tr.Par').removeClass('mandatory');
		if(affichClass == 'CV')
		    $('#CTRL tr.Par').addClass('mandatory');
		if(affichClass == 'FI'){
		    $('tr.lieu').hide();
		    $('#numS').addClass('toValidate').removeClass('validated');
		    $('#numC').addClass('toValidate').removeClass('validated');
		    $('button.ValidateNums').fadeIn('slow');
		    numSC_Change();
		}
	    });
	    $('#CTRL .menu.lieu .radio input:radio').change(function(){
		var affichClass=$(this).val();
		// Si le bt radio verification est coché:
		if ($("input:radio[value='CV']").next().attr('aria-pressed')){
		    if (affichClass == 'S')
			$('#CTRL tr.site').show();
		    else
			$('#CTRL tr.site').hide();
		}

	    });

	    $('#CTRL tr.menu.lieu .radio input:radio').change(function(){
		var lieu=($(this).attr('id'));
		switch (lieu){
		    case 'site':
			var num = $('#CTRL input#num').attr('defaut');
			$('#CTRL input#num').val(num);
			// Tester si on peut préselectionner le client
			$.ajax({
				type: 'GET',
				url: "testCliSite.php",
				data: {date:$('#CTRL #date').val()},
				dataType: 'json',
				cache: false,
				timeout: 7000,
				success: function(data) {
				    $("#CTRL select#cli option[value='" + data.cli + "']").attr("selected","selected");
				    $("#CTRL select#cli").next().val($('#CTRL select#cli option:selected').text());
				}
			});
			break;
		    case 'atelier':
			$('#CTRL input#num').val('');
			break;
		}
	    });
	        
            $('#CtrlClear').click(function(){
                $('.ui-tabs-panel:visible').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");
                $('.ui-tabs-panel:visible').load(tab.page,function(){reloadContent();CTRL_UpdateSubmitClick(tab.ajout);});
            });
	        
	    $('#ajoutParCtr').click(function(){
		$('#dialogParCtr').dialog('open');
		$('#dialogParCtr').dialog({'title':'Paramètres vérifiés:'});
	    });
	    $('#ajoutMMCtr').click(function(){
		$('#dialogMMCtr').dialog('open');
		$('#dialogMMCtr').dialog({'title':'Moyens de mesure employés:'});
	    });
	    // Colorer les CB checked dans les dialogs
	    $('.dialog input:checkbox:checked').each(function(){
		$(this).parent().next().css('color','#EB8F00');
	    });
	    //$("input#search").val('');
	    $("li.search").hide();
	        
        } // FIN INSTRUCTIONS CTRL
	if(tab.page == 'controle.php'){
	    $("li.search").show();
	    $('.ui-tabs-panel:visible table th:visible').first().addClass("topLeft");
	    $('.ui-tabs-panel:visible table th:visible').last().addClass("topRight");
	    // Remove extra .target kept in DOM !important
	    $(".target").not(":eq(0)").remove();
	    $("#tabCtr table th").contextMenu("#tabCtr #menuTable");
	    $("#tabCtr table#tableCol").columnManager({listTargetID:'menuTable', onClass: 'simpleon', offClass: 'simpleoff', hideInList: [1,11], colsHidden: []});
	    $("#tabCtr table.tableau tr").click(function(){
		// Color selected row
		$("#tabCtr tr.selected").removeClass('selected');
		$(this).addClass('selected'); 
	    }); 
	}
        if(tab.page == 'option.php'){
	    $.ajax({
		type: 'GET',
		url: "checkHisto.php",
		dataType: 'json',
		success: function(data) {
		    if(data.empty == false){
			blinking(true);
		    }
		}
	    });
	    $('#sync').click(function(){
		SYNC();
	    });
	}
	/*$('img.suppr').click(function(){*/
	/*if($('.dialog').dialog('isOpen')) return false;*/
	/*else{*/
	/*var par = $(this).parent().parent();*/
	/*$("#dialog-confirm #confirmMess").html("Voulez-vous vraiment supprimer "+par.children(':nth-child(2)').text()+"?");*/
	/*$("#dialog-confirm").dialog("option","title","Suppression!");*/
	/*$("#dialog-confirm").dialog(*/
	/*"option",*/
	/*"buttons",{*/
	/*"Supprimer":function(){*/
	/*submitForm('id='+getChildText(par,'id'),tab.suppr);*/
	/*$("#dialog-confirm").dialog('close');*/
	/*},*/
	/*"Annuler":function(){*/
	/*$("#dialog-confirm").dialog('close');*/
	/*}*/
	/*}*/
	/*);*/
	/*$("#dialog-confirm").dialog('open');*/
	/*}*/
	/*});*/
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
            $(this).parent().parent().children(':nth-child(4)').children('select').children('option').each(function(){
                console.log(this);
                var idMM = $(this).val();
                $('#dialogParMM input:checkbox').each(function(){
                    if($(this).val() == idMM) {
                        $(this).attr('checked',true);
                        $(this).parent().next().css('color','#EB8F00');
                    }
                });
            });
        });
        
	$('.dialog input:checkbox').change(function(){
	    if($(this).attr('checked')=='checked')
		$(this).parent().next().css('color','#EB8F00');
	    else 
		$(this).parent().next().css('color','black');
	});
        // appel du generatePdf.php
        $("a.pdfEdit").click(function(e){
            e.preventDefault();
            lien = $(this).attr('href');
            $("#dialog-confirm #confirmMess").html("Voulez vous intégrer l'en-tête en fond du PDF?");
            $("#dialog-confirm").dialog("option","title","PDF avec en-tête?");
            $("#dialog-confirm").dialog("option","buttons",
                                                            {"Oui":function(){
                                                                window.open(lien+"&bg=1");
                                                                $("#dialog-confirm").dialog('close');
                                                            },"Non":function(){
                                                                window.open(lien+"&bg=0");
                                                                $("#dialog-confirm").dialog('close');
                                                            }});
            $("#dialog-confirm").dialog('open');

        })

        $("a.pdfEdit").mousedown(function(e){
	    if(e.which === 3){
		$("#tabCtr tr.selected").removeClass('selected');
		$(this).parent().parent().addClass('selected'); 
	    }
	});
	// BOUTTONS GLISSANTS ////////////////////////////////////////////////////////////
	placerBtAjout();                                                               ///
										       ///
//	$('button.btAjout').stop().animate({'marginRight':'0'},1000);                  ///
	$('button.btAjout').hover(function(){                                          ///
	    $(this).stop().animate({'marginRight':($(this).width()-45)+'px'},200);     ///
	},function(){                                                                  ///
	    $(this).stop().animate({'marginRight':'0'},200);                           ///
	});                                                                            ///
	//////////////////////////////////////////////////////////////////////////////////
    }
    // FIN RELOAD CONTENT
     

    function updateSubmitClick(php, cssButton, formData){
        if(cssButton === undefined) cssButton = tab.dialogId+' button.submit';
        if(formData === undefined) formData = "$(tab.dialogId+' form.formulaire').first().serialize()";
        $(cssButton).unbind('click');
        $(cssButton).click(function(e){
            e.preventDefault();
            // if(validateForm()){
	    if(tab.page == 'ctrl.php'){
		if(!$('input#numS').hasClass('validated')) {
		    displayMess("<img src='img/error.png'/><h2>Numéros non validés!</h2>","ui-state-error",2000);
		    return false;
		}
	    }
            dataSend = eval(formData);
            submitForm(dataSend, php);
            $('.dialog').dialog('close');
            // }else{$('#Formulaire #response').removeClass().addClass('error').html('Remplissez le formulaire comme demand\351!').fadeIn('fast');}
        });
    }
    function CTRL_UpdateSubmitClick(action){
         updateSubmitClick(
            action,
            tab.dialogId+' button.submit',
            "$(tab.dialogId+' form.formulaire').first().serialize() + '&PAR=' + $('#dialogParCtr input:checkbox:checked').map(function(){return $(this).val()}).get().join(',') + '&MM=' + $('#dialogMMCtr input:checkbox:checked').map(function(){return $(this).val()}).get().join(',');"
         );
    }
    
    function updateTAb(){
        tab.page = $('.ui-tabs-panel:visible').last().attr('page');
        tab.ajout = $('.ui-tabs-panel:visible').last().attr('ajout');
        tab.suppr = $('.ui-tabs-panel:visible').last().attr('suppr');
        tab.modif = $('.ui-tabs-panel:visible').last().attr('modif');
        tab.dialogId = $('.ui-tabs-panel:visible').last().attr('dialogId');
        tab.needReload = $('.ui-tabs-panel:visible').last().attr('needReload');
    }
    function refreshTabClick(){
//        $('ul.ui-tabs-nav a').unbind();
//        $('.tabs').tabs();
        // CLICK SUR TAB ////////////////////////////////////////////////////////////////////////////
        $('ul.ui-tabs-nav a').click(function(){
            updateTAb();
            // Vérifier si la tab necessite d'etre rechargé
            if(tab.needReload == "true"){
                $('.ui-tabs-panel:visible').html("<h1 style='margin-left:10%;'>Chargement ...</h1>");
                $('.ui-tabs-panel:visible').load(tab.page,function(){reloadContent();});
            }
            if(tab.page == 'ctrl.php'){
		//$("input#search").val('');
                $("li.search").hide();
		if(!CTRL_Ready) reloadContent();
		/*CTRL_UpdateSubmitClick(tab.ajout);*/
                // Delai car tout element de la tab deviennent visible après le click
                var wait = setTimeout(refreshCtrlTable,10);
            }else{
		$("li.search").show();
		//$('input#search').val('');
		//$('input#search').quicksearch('.ui-tabs-panel:visible table.tableau tbody tr');
		placerBtAjout();
	    }
            console.log("click sur tab! tab.page: "+tab.page);
        });
    }

    
    function refreshCtrlTable(){
        if(AClass = $('#CTRL .menu.type .radio input:radio:checked').val()){
	    console.log("refreshCtrlTable");
	    console.log(AClass);
            $('#CTRL tr:not(.'+AClass+')').hide();
            $('#CTRL tr.static').show();
            $('#CTRL tr.'+AClass).show();
            // Afficher/Cacher Température
            if(AClass == 'CV'){
                if($('.menu.lieu .radio input:radio:checked').val() == 'S')
                    $('#CTRL tr.site').show();
                else
                    $('#CTRL tr.site').hide();
            }
	    if(AClass == 'CE'){
		$('#CTRL tr.Par').removeClass('mandatory');
	    }
	    if(AClass == 'FI'){
		$('#CTRL tr.lieu').hide();
	    }else if(!$('#CTRL tr.lieu').is(':visible')) $('tr.lieu').show();
        }else{
            $('#CTRL tr:not(.menu)').hide();
        }
    }

    // retourne le contenue textuel d'un élément Enfant
    function getChildText(parentEl,id){
	return parentEl.children('td#'+id).text();
    }
    
    function submitForm(formData, URL){
	console.log(formData + " " + URL);
	$.ajax({
	    type: 'POST',
	    url: URL,
	    data: formData,
	    dataType: 'json',
	    cache: false,
	    timeout: 7000,
	    success: function(data) {
		if (data.error){
		    displayMess("<img src='img/error.png'/><h3>"+data.msg+"</h3>", "ui-state-error",2000);
		}else{
		    displayMess("<img src='img/icon_ok.png'/><h3>"+data.msg+"</h3>", "ui-state-highlight",1500);
		    if(tab.page == "ctrl.php") {
			$(".tabs").tabs({'selected':tabNum});
			tab.page = "controle.php";
		    }
		    $('.ui-tabs-panel:visible').load(tab.page,function(){updateTAb();reloadContent();});
		}
	    },
	    error: function(XMLHttpRequest, textStatus, errorThrown){
		alert("D\351sol\351! Il y a eu une erreur: " + errorThrown + " " + textStatus+" Veuillez contacter Thibaud SMITH afin de résoudre ce problème!");
    
	    }
	});
    }
    function displayMess(mess, Class, timeOut){
	$('#message').html(mess).removeClass('ui-state-highlight ui-state-error').addClass(Class + ' ui-corner-all').show();
	setTimeout(function(){$('#message').hide();},timeOut);
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
	
    function placerBtAjout(){
        $('.btAjout').each(function(){
            $(this).css('right','-'+($(this).width()-45)+'px')
        });
    }
    
    function SYNC(){
	console.log("sync");
        $.ajax({
	    type:'POST',
            url:'syncGetModif.php',
            dataType:'json',
            success: function(data) {
		console.log(data);
		blinking(false);
                for (var i in data)
                    execModif(data[i]);
		displayMess("<h3>" + data.length + " modifications effectuées sur le serveur distant!</h3>","ui-state-highlight",2000);
            }
        });
    }
    function execModif(dataModif){
	console.log('execModif'+dataModif);
        $.ajax({
            url:"http://88.191.153.53/MultisysControles/syncModif.php",
            dataType:'jsonp',
            data: dataModif,
            jsonp:'callback',
            success: function(data) {
                console.log(data);
            }
        });
    }

    var timer;
    function blinking(on) {
	if(on){
	    timer = setInterval(blink, 10);
	    function blink() {
		$('#sync').fadeOut(400, function() {
		    $('#sync').fadeIn(400);
		});
	    }
	}else{
	    clearInterval(timer);
	}
    }
}
// FIN INIT()

function numSC_Change(){
    $('input.toValidate').unbind('change');
    $('input.toValidate').change(function(){
	$('input.validated').removeClass('validated');
	$('button.ValidateNums').fadeIn('slow');
    });
}
////////////////    Initialisation des combobox autocomplete    ////////////////

(function( $ ) {
//    function comboSelectDefault(select){
//       if($(select + ' option').size() == 1) {
//            $(select + ' option').attr("selected","selected");
//            $(select).next().val($(select + ' option:selected').text());
//        }
//    }
//    // on SELECT sur une des 3 select pour APPAREIL
//	function comboboxSelect(ui, input){
//	    var select = $(input).prev();
//	    var option = escape(ui.item.value);
//	    var id = select.attr('id');
//	    console.log(ui.item.value);
//	    switch (id){
//	        case "AppDesi":
//	            $('select#AppMarq').load("comboSearchApp.php?field=MARQUE&knownField=DESIGNATION&term="+option,
//	                                    function(){$('select#AppMarq').next().val("");comboSelectDefault('select#AppMarq');});
//	            $('select#AppType').load("comboSearchApp.php?field=TYPE&knownField=DESIGNATION&term="+option,
//	                                    function(){$('select#AppType').next().val("");comboSelectDefault('select#AppType');});
//	            break;
//	            
//	        case "AppMarq":
//	            if($('select#AppDesi').next().val() == "")
//	                $('select#AppDesi').load("comboSearchApp.php?field=DESIGNATION&knownField=MARQUE&term="+option,
//                                            function(){$('select#AppDesi').next().val("");comboSelectDefault('select#AppDesi');});
//	            $('select#AppType').load("comboSearchApp.php?field=TYPE&knownField=MARQUE&term="+option,
//	                                    function(){$('select#AppType').next().val("");comboSelectDefault('select#AppType');});
//	            break;
//	            
//	        case "AppType":
//	            if($('select#AppDesi').next().val() == "")
//    	            $('select#AppDesi').load("comboSearchApp.php?field=DESIGNATION&knownField=TYPE&term="+option,
//	                                        function(){$('select#AppDesi').next().val("");comboSelectDefault('select#AppDesi');});
//                if($('select#AppMarq').next().val() == "")
//    	            $('select#AppMarq').load("comboSearchApp.php?field=MARQUE&knownField=TYPE&term="+option,
//	                                        function(){$('select#AppMarq').next().val("");comboSelectDefault('select#AppMarq');});
//	            break;
//	    }
//	}
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
					    var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex(request.term), "i" );
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
					    // Make sure it's white in case it wasn't
					    if($(this).css('background-color') == 'rgb(255, 165, 0)') $(this).css('background','#E0E0E0');
					    // Update date on select tech on modif CTRL when tech not selected
					    if(select.attr('id') == "technicien" && $('#CTRL').hasClass('modifCtrl') && prerempli){
						console.log("prerempli = "+prerempli);
						$("#CTRL #date").val(getFormatedDate());
						$("#CTRL #date").change();
						// nums to validate
					    }
					    if(select.attr('id') == 'technicien'){
						console.log('tech select');
						$('#numS').addClass('toValidate').removeClass('validated');
						$('#numC').addClass('toValidate').removeClass('validated');
						$('button.ValidateNums').fadeIn('slow');
						numSC_Change();
					    }
				    },
				    change: function( event, ui ) {
					    console.log(select.attr('id'));
					    if ( !ui.item ) {
						    var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
							valid = false;
						    select.children( "option" ).each(function() {
							    if ( $( this ).text().match( matcher ) ) {
								    this.selected = valid = true;
								    console.log("lkj");
								    return false;
							    }
						    });
						    if ( !valid ) {
							    // remove invalid value, as it didn't match anything
//								$( this ).val( "" );
//								select.val( "" );
//								console.log(input);
//								input.data( "autocomplete" ).term = "";
							if($(this).parent().parent().hasClass('autoInsert')){
							    select.children("option:selected").removeAttr("selected");
							    $(this).css('background','orange');
							    $(select).append("<option selected='selected' value='%"+$(this).val()+"'></option>");
							    return false;
							}
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
		    if(!select.hasClass('noArrow')) this.button = $( "<button type='button'>&nbsp;</button>" )
			    .attr( "tabIndex", -1 )
			    .attr( "title", "Tout afficher" )
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
