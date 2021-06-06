/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#mesmission-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxservices/liste-mes-missions',
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
        $('td:eq(0)', nRow).html("<a href='mission/voir-details/"+aData[0]+"'>"+aData[1]+"</a>");
        $('td:eq(1)', nRow).html(aData[6]);
        $('td:eq(2)', nRow).html(aData[2]);
        $('td:eq(3)', nRow).html(aData[3]);
        $('td:eq(4)', nRow).html(aData[4]);
        $('td:eq(5)', nRow).html(getBtn(aData[0]));
    }
});});

function getBtn(id){
    
    var btnDelete = "<a href='"+basePath+"/mission/voir-details/"+id+"' data-toggle='tooltip' data-placement='top' title='Modifier assignation' " +
                "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
                "            <i class='feather-eye'></i> " +
                "        </a> ";
     

    /**/
    
    return btnDelete;
    
}