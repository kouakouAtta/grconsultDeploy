/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();
    
});

function selectServiceByAgent()
{
	$.ajax({
            
            method: "POST",
            url: basePath+"/ajaxservices/liste-service-mvt",
            data: {
                id: $('#idSalarie').val()
            }}).done(function( allServices ) {
                $('#idService').empty();
                $.each(allServices, function (id, name) {
                    $('#idService').append('<option value="'+id+'">'+name+'</option>');
                });
                $('#idService').select2();
            });
}