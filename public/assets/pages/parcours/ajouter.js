/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    $(".dropify").dropify({
    messages:{
        default:"Faites glisser ou cliquer pour ajouter un justificatif",
            replace:"Faites glisser ou cliquer pour modifier cette image",
            remove:"Supprimer",
            error:"Ooops, une erreur a été rencontrée."
        },
        error:{
            fileSize:"La taille du fichier est trop grande (1M max)."
        }
    });
    $('[data-toggle="select2"]').select2();
});