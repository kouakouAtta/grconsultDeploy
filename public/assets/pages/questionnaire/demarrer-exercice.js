/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    nbreQuestion = $('#nbreQuestion').val();
    
    for(i=2; i<=nbreQuestion; i++){
        $('#div'+i).hide();
    }
    $('#terminer').hide();
    $('#precedent1').attr('style','pointer-events: none;cursor: default;');
    $('#suivant'+nbreQuestion).attr('style','pointer-events: none;cursor: default;');

});

function switchQuestion(j){
    $('#div'+j).show();
    for(i=1; i<=nbreQuestion; i++){
        if(j!=i)
            $('#div'+i).hide();
    }
    
    if(j==5)
        $('#terminer').show();
    else
        $('#terminer').hide();
}