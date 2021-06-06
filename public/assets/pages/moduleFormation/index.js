/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#module-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxelearning/liste-modules',
    sServerMethod: 'post',
    fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
        oSettings.jqXHR = $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
          "data": {
                  autre : 2
                },
          "success": fnCallback
    })},
    
    oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},

    fnRowCallback: function(nRow, aData, iDisplayIndex){
        $('td:eq(0)', nRow).html(aData[1]);
        $('td:eq(1)', nRow).html(formatDateMysql(aData[3]));
        $('td:eq(2)', nRow).html(formatDateMysql(aData[4]));
        $('td:eq(3)', nRow).html(getBtn(aData[0]));
    }
});});


function getBtn(id){
    
    var btnDelete = 
            "        <a  href='"+basePath+"/module/lire-module/"+id+"' data-toggle='tooltip' data-placement='top' title='Lire le cours' " +
            "            class='btn btn-outline-warning waves-effect waves-light'> " +
            "             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='feather-book-open' style='font-size:20px;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " +
            "        </a> ";
    
    return btnDelete;
    
}