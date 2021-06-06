/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#questionnaire-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajaxelearning/questionnaires-proposes',
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
        $('td:eq(1)', nRow).html(aData[2]);
        $('td:eq(2)', nRow).html(aData[3]);
        $('td:eq(3)', nRow).html(aData[4]+" "+aData[5]+" "+aData[6]);
        $('td:eq(4)', nRow).html(getBadge(aData[7]));
        $('td:eq(5)', nRow).html(aData[8]+" min");
    }
});});

function getBadge(statut){
    if(statut == '0'){
        return '<span class="badge badge-soft-warning" style="font-size:12px;">Non activé</span>';
    }
    else if(statut == "1"){
        return '<span class="badge badge-soft-success" style="font-size:12px;">Activé</span>';
    }
}

function getBtn(aData){
    
    if(aData[7] == '0'){
        var btnDelete = 
            "        <a href='"+basePath+"/questionnaire/activer/"+aData[0]+"' data-toggle='tooltip' data-placement='top' title='Activer' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-check'></i> " +
            "        </a> ";
    }
    else if(aData[7] == "1"){
        var btnDelete = 
            "        <a href='"+basePath+"/questionnaire/desactiver/"+aData[0]+"' data-toggle='tooltip' data-placement='top' title='Désactiver' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-x'></i> " +
            "        </a> ";
    }
    
    return btnDelete;
    
}