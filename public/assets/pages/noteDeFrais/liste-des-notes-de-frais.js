/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#note-de-frais-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxservices/liste-des-notes-de-frais',
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
        $('td:eq(0)', nRow).html(aData[1]);
        $('td:eq(1)', nRow).html(aData[2]+" "+aData[3]+" "+aData[4]);
        $('td:eq(2)', nRow).html(aData[5]);
        $('td:eq(3)', nRow).html(aData[9]);
        $('td:eq(4)', nRow).html(getBtn(aData[0]));
    }
});})

function getBtn(id){
    
    var btnDelete = 
            "        <a href='"+basePath+"/note-de-frais/voir-details/"+id+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/note-de-frais/confirmer/"+id+"' data-toggle='tooltip' data-placement='top' title='Valider' " +
            "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-check'></i> " +
            "        </a> ";
    
     btnDelete += 
            "        <a href='"+basePath+"/absence/refuser/"+id+"' data-toggle='tooltip' data-placement='top' title='Refuser' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-slash'></i> " +
            "        </a> ";
    
    return btnDelete;
    
}