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
        $('td:eq(0)', nRow).html(alignCenter(formatDateMysql(aData[1])));
        $('td:eq(1)', nRow).html(alignCenter(aData[2]));
        $('td:eq(2)', nRow).html(alignCenter(getBadge(aData[8])));
        $('td:eq(3)', nRow).html(alignCenter(getBtn(aData[0])));
    }
});});

function getBadge(statut){
    if(statut == null){
        return '<span class="badge badge-soft-warning" style="font-size:12px;">En attente</span>';
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
            "        <a href='javascript:showDetailsModal("+id+");'  title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light detailBtn'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    
    return btnDelete;
    
}

function showDetailsModal(id){
    $.ajax({
        type: "POST",
        url: basePath+"/ajax/liste-des-details-demande",
        data: {
            id: id
        },
        //dataType: "html",
        success: function (details) {
            for (var detail in details) {
                text = "<div class='row'><div class='col-2'><p>Matériel <br><span style='font-weight: bold;'>"+details[detail].libelle+"</span></p></div>";
                text += "<div class='col-2' style='text-align:center'><p>Quantité <br><span style='font-weight: bold;'>"+details[detail].quantiteVoulue+"</span></p></div>";
                text += "<div class='col-7'><p>Destinataires <br><span style='font-weight: bold;'>";
                for(var index in details[detail].personnesConcernees){
                    text +=details[detail].personnesConcernees[index].fullName+", ";
                }
                text +="</span></p></div></div><br>";
                $( "#details" ).html( text);
            }
            $( "#detailsModal" ).modal();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("error");
        }
    });
}