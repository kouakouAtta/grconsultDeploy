/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
$(document).ready(function() {
    $('#function').on('change',function(){
        userFunction = $('#function').val();
        getServices(userFunction);
    });
    
    
});

function getServices(userFunction){
    
    $.ajax({
        method: "POST",
        url: basePath + '/ajax/get-services',
        data: 'userFunction=' + userFunction
    })
    .done(function( allServices ) {
        $('#service').empty();
        $.each(allServices, function (id, name) {
            $('#service').append('<option value="'+id+'">'+name+'</option>');
        });
        $('#service').selectpicker('refresh');
    })
    /*.error(function(jqXHR, textStatus, errorThrown ){
              alert(textStatus+' : '+errorThrown);  
    })*/
    ;
    
}
