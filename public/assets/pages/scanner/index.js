/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#scanner-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajax/liste-des-scanners',
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
        $('td:eq(0)', nRow).html(aData[2]);
        $('td:eq(1)', nRow).html(aData[5]);
        $('td:eq(2)', nRow).html(aData[6]);
        $('td:eq(3)', nRow).html(aData[4]);
        $('td:eq(4)', nRow).html(getBtn(aData[0]));
    }
});});

function getBadge(statut){
    if(statut == '0'){
        return '<span class="badge badge-soft-warning" style="font-size:12px;">A valider</span>';
    }
    else if(statut == "1"){
        return '<span class="badge badge-soft-success" style="font-size:12px;">Validée</span>';
    }
    else{
        return '<span class="badge badge-soft-danger" style="font-size:12px;">Refusée</span>';
    }
}

function getBtn(id){
    
    var btnDelete = 
            "        <a href='"+basePath+"/absence/voir-details/"+id+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/absence/modifier/"+id+"' data-toggle='tooltip' data-placement='top' title='Valider' " +
            "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-edit'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/absence/supprimer/"+id+"' data-toggle='tooltip' data-placement='top' title='Refuser' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-trash'></i> " +
            "        </a> ";
    
    return btnDelete;
    
}