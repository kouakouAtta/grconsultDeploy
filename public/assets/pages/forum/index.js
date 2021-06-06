/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/
var modules = {};

$(document).ready(function(){
    $('[data-toggle="select2"]').select2();
    $("#forum-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxelearning/liste-forum-questions',
    sServerMethod: 'post',
    fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
        oSettings.jqXHR = $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
          "success": fnCallback
    })},
    
    oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},

    fnRowCallback: function(nRow, aData, iDisplayIndex){
        $('td:eq(0)', nRow).html(aData[1]+" "+aData[2]+" "+aData[3]);
        $('td:eq(1)', nRow).html(aData[4]);
        $('td:eq(2)', nRow).html(aData[5]);
        $('td:eq(3)', nRow).html(aData[7]);
        $('td:eq(4)', nRow).html(getBtn(aData[0]));

    }
});});

function getBtn(id){
    
    var btnDelete = 
                "        <a href='"+basePath+"/forum/voir-reponses/"+id+"' data-toggle='tooltip' data-placement='top' title='Voir les reponses' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-plus-circle'></i> Reponses" +
            "        </a> ";
    
    return btnDelete;
    
}
