/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#liste-demande-user-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajax/liste-des-demandes-pour-un-agent',
    sServerMethod: 'post',
    fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
        oSettings.jqXHR = $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
          "data": {
                  demandeId : $('#demandeId').val(),
                  userId : $('#userId').val()
                },
          "success": fnCallback
    })},
    language:{
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher :",
        "sLengthMenu":     "Afficher _MENU_ éléments",
        "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
        "sInfoFiltered":   "(filtré de _MAX_ éléments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun élément à afficher",
        "sEmptyTable":     "Aucune donnée disponible dans le tableau",

        "oPaginate": {
            "sFirst":      "Premier",
            "sPrevious":   "Précédent",
            "sNext":       "Suivant",
            "sLast":       "Dernier"
        },

        "oAria": {
            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
        },

        paginate:{
            previous:"<i class='mdi mdi-chevron-left'>",
            next:"<i class='mdi mdi-chevron-right'>"
        }
    },


    fnRowCallback: function(nRow, aData, iDisplayIndex){
        $('td:eq(0)', nRow).html(formatDateMysql(aData[1]));
        $('td:eq(1)', nRow).html(formatDateMysql(aData[4]));
        $('td:eq(2)', nRow).html(formatDateMysql(aData[5]));
        $('td:eq(3)', nRow).html(getBadge(aData[6]));
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
            "             <i class='feather-check'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/absence/modifier/"+id+"' data-toggle='tooltip' data-placement='top' title='Refuser' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-slash'></i> " +
            "        </a> ";
    
    return btnDelete;
    
}