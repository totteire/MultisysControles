$(document).ready(function(){
    $(".tabs" ).tabs();
    $("#tableau").tablesorter();
    $("input:submit, button").button();
    $("#dialogClient").dialog({
        autoOpen: false,
        width: 'auto',
    });
    $('.btAjout').click(function(){
        $("#dialogClient").dialog('open');
    });
});
