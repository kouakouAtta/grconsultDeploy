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

    setCodeBordereau();
});

function setCodeBordereau()
{
    $("#ajouterMaterielEnPlusBtn").on('click',function(){
        //alert('vous avez clicqué');
        var valBordereau=$("#numeroLivraison").val();
        $("#codeBordereau").val(valBordereau);
        var valBordereauCode=$("#codeBordereau").val();
        console.log('vous avez cliqué, la valeur recupéré est : '+valBordereau);
        console.log('le input  recupéré est : '+valBordereauCode);
    });
}