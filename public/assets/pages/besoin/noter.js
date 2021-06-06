/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();
    
    var defaultOptions={}; somme = 0;
    
    $('[data-toggle="touchspin"]').each(function(a,e){
        var t=$.extend({},defaultOptions,$(e).data());
        $(e).TouchSpin(t);
        
    });
    
    $("#note-datatable").DataTable(
    {
        iDisplayLength: 10,
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
    });

    $('#note1').on('blur',function(){
       somme = parseFloat($('#note1').val()) + parseFloat($('#note2').val()) + parseFloat($('#note3').val())
                + parseFloat($('#note4').val());
        if($('#note1').val() != "" && $('#note2').val() != "" && $('#note3').val() != "" && $('#note4').val() != ""){
            $('#total').val(somme.toString());
        }
    });
    $('#note2').on('blur',function(){
        somme = parseFloat($('#note1').val()) + parseFloat($('#note2').val()) + parseFloat($('#note3').val())
                + parseFloat($('#note4').val());
        if($('#note1').val() != "" && $('#note2').val() != "" && $('#note3').val() != "" && $('#note4').val() != ""){
            $('#total').val(somme.toString());
        }
    });
    $('#note3').on('blur',function(){
        somme = parseFloat($('#note1').val()) + parseFloat($('#note2').val()) + parseFloat($('#note3').val())
                + parseFloat($('#note4').val());
        if($('#note1').val() != "" && $('#note2').val() != "" && $('#note3').val() != "" && $('#note4').val() != ""){
            $('#total').val(somme.toString());
        }
    });
    $('#note4').on('blur',function(){
        
        somme = parseFloat($('#note1').val()) + parseFloat($('#note2').val()) + parseFloat($('#note3').val())
                + parseFloat($('#note4').val());
        if($('#note1').val() != "" && $('#note2').val() != "" && $('#note3').val() != "" && $('#note4').val() != ""){
            $('#total').val(somme.toString());
        }
    });
});