/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#miissions-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxservices/liste-des-missions',
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
        $('td:eq(5)', nRow).html(getBtn(aData[5], aData[3], aData[0]));
    }
});});

function getBtn(issigne, datefin, id){
    
    var btnDelete = "";

    var dateJ = $('#datej').val();

    if(datefin < dateJ)
    {
        btnDelete = '<span class="badge badge-soft-danger" style="font-size:12px;">Expirée</span>';
    }else
    {
        if(issigne=='1')
        {
           btnDelete =
                " <a href='"+basePath+"/mission/modifier-assigne/"+id+"' data-toggle='tooltip' data-placement='top' title='Modifier assignation' " +
                "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
                "             <i class='fas fa-allergies'></i> " +
                "        </a> ";
        }else
        {
            btnDelete = 
                "        <a href='"+basePath+"/mission/assignation/"+id+"' data-toggle='tooltip' data-placement='top' title='Assigné' " +
                "            class='btn btn-outline-warning btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-activity'></i> " +
                "        </a> ";
        
           btnDelete += 
                "        <a href='"+basePath+"/mission/modifier/"+id+"' data-toggle='tooltip' data-placement='top' title='Modifier' " +
                "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-edit'></i> " +
                "        </a> ";
        
           btnDelete += 
                "        <a href='"+basePath+"/mission/supprimer/"+id+"' data-toggle='tooltip' data-placement='top' title='Supprimer' " +
                "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-trash'></i> " +
                "        </a> ";
        } 
    }

    /**/
    
    return btnDelete;
    
}