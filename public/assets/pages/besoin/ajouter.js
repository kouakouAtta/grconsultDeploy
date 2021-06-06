/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();
    
    $('[data-toggle="input-mask"]').each(function(a,e){
        var t=$(e).data("maskFormat"),n=$(e).data("reverse");
        null!=n?$(e).mask(t,{reverse:n}):$(e).mask(t);});
    
    $(".dropify").dropify({
    messages:{
        default:"Faites glisser ou cliquer pour ajouter une image",
            replace:"Faites glisser ou cliquer pour modifier cette image",
            remove:"Supprimer",
            error:"Ooops, une erreur a été rencontrée."
        },
        error:{
            fileSize:"La taille du fichier est trop grande (1M max)."
        }
    });


});