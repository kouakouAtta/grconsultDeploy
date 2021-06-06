/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){
    $("#note-datatable").DataTable({
        iDisplayLength: 10,
        searching: false,
        sAjaxSource: basePath + '/ajaxelearning/mes-notes',
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
            $('td:eq(0)', nRow).html(aData[5]);
            $('td:eq(1)', nRow).html(formatDateTimeMysql(aData[2]));
            $('td:eq(2)', nRow).html(aData[6]+" / "+aData[7]);
            $('td:eq(3)', nRow).html(getBadge(aData));
        }
    });
    
    $("#stat-datatable").DataTable({
        iDisplayLength: 10,
        "bInfo" : false,
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
        searching: false
    });
});

function getBadge(aData){
    moyenne = parseInt(aData[7]/2)+1;
    
    if(aData[6]<moyenne){
        return '<span class="badge badge-soft-warning" style="font-size:12px;">Non validée</span>';
    }
    else{
        return '<span class="badge badge-soft-success" style="font-size:12px;">Validée</span>';
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