/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#note-de-frais-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxservices/liste-de-mes-notes-de-frais',
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
        $('td:eq(0)', nRow).html(aData[2]+" "+aData[3]+" "+aData[4]);
        $('td:eq(1)', nRow).html(aData[5]);
        $('td:eq(2)', nRow).html(aData[9]);
        $('td:eq(3)', nRow).html(getBtn(aData));

    }
});})

function getBtn(data){
    
    var btnDelete ="";
    var disabled = "";
    if(data[15] != null){
        disabled = "style='pointer-events: none;cursor: default;'";
    }
    
    btnDelete += 
        "        <a href='"+basePath+"/note-de-frais/voir-details/"+data[0]+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
        "            class='btn btn-outline-primary btn-rounded waves-effect waves-light'> " +
        "             <i class='feather-eye'></i> " +
        "        </a> ";
        btnDelete += 
            "        <a " + disabled + " href='"+basePath+"/note-de-frais/soumettre/"+data[0]+"' data-toggle='tooltip' data-placement='top' title='Soummettre' " +
            "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-navigation'></i> " +
            "        </a> ";
        btnDelete += 
            "        <a " + disabled + " href='"+basePath+"/note-de-frais/modifier/"+data[0]+"' data-toggle='tooltip' data-placement='top' title='Modifier' " +
            "            class='btn btn-outline-warning btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-edit'></i> " +
            "        </a> ";
    
        btnDelete += 
                "        <a " + disabled + " href='"+basePath+"/note-de-frais/supprimer/"+data[0]+"' data-toggle='tooltip' data-placement='top' title='Supprimer' " +
                "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-trash'></i> " +
                "        </a> ";
    
    return btnDelete;
    
}