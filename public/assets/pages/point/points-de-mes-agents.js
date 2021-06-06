/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#exportExcel, #exportExcel2').on('click',function(){
        $('#frmExportExcel').submit();
        return false;
    });
    
    $('#exportWord, #exportWord2').on('click',function(){
        $('#frmExportWord').submit();
        return false;
    });
    
    $('#validatePoints, #validatePoints2').on('click',function(){
        /*if( confirm("Vous êtes sur le point de valider les points d'activités de votre service. \n\n Voulez-vous vraiment les validés ?") ){
            $('#frmValidatePoints').submit();
        }*/
        swal({
            title:"Confirmation",
            text:"Vous êtes sur le point de valider les points d'activités de votre service. \n\n Voulez-vous vraiment les validés ?",
            type:"warning",
            cancelButtonText:"Annuler",
            showCancelButton:!0,
            confirmButtonText:"Oui, valider",
            confirmButtonColor:"#f29d56",
            closeOnConfirm:!1
        },
            function(){$('#frmValidatePoints').submit();}
        );
        
        return false;
    });
    
});
