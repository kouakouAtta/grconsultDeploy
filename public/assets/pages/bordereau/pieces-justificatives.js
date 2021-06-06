/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();
    
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
    
    $("#piece-datatable").DataTable(
    {
        searching: false,
        "bInfo" : false,
        iDisplayLength: 10,
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
    });

});