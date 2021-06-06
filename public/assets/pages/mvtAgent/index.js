/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/
$(document).ready(function(){$("#mvtagent-datatable").DataTable(
{
    iDisplayLength: 10,//listeDesMvtAgentProposeByAllUserAction
    sAjaxSource: basePath + '/ajaxservices/liste-des-mvt-agent-propose-by-all-user',
    sServerMethod: 'post',
    fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
        oSettings.jqXHR = $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
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
        $('td:eq(0)', nRow).html(aData[16]);
        $('td:eq(1)', nRow).html(aData[25]+" "+aData[26]+" "+aData[27]);
        $('td:eq(2)', nRow).html(aData[1]);
        $('td:eq(3)', nRow).html(aData[17]);
        $('td:eq(4)', nRow).html(aData[48]);
        $('td:eq(5)', nRow).html(getBadge(aData[9], aData[11]));
        $('td:eq(6)', nRow).html(getBtn(aData[18], aData[9]));

    }
});});

function getBadge(isvalide, issigne){
    if(isvalide == '0' && issigne=="0"){
        return '<span class="badge badge-soft-warning" style="font-size:12px;">A valider</span>';
    }
    else if(isvalide == "1" && issigne=="0"){
        return '<span class="badge badge-soft-success" style="font-size:12px;">Validée</span>';
    }else if(isvalide=="1" && issigne=="1")
    {
      return '<span class="badge badge-soft-info" style="font-size:12px;">Signé</span>';
    }
    else
    {
        return '<span class="badge badge-soft-danger" style="font-size:12px;">Refusée</span>';
    }
}

function getBtn(id, isvalide){
    
    var btnDelete = "";

    if(isvalide=='1')
    {
        btnDelete =   
            "<a href='"+basePath+"/mouvement-agent/voir-details/"+id+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    }else{

         btnDelete = 
            "        <a href='"+basePath+"/mouvement-agent/voir-details/"+id+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    
         btnDelete += 
            "        <a href='"+basePath+"/mouvement-agent/validate-demande/"+id+"' data-toggle='tooltip' data-placement='top' title='Valider' " +
            "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-check'></i> " +
            "        </a> ";
     
         btnDelete += 
            "        <a href='"+basePath+"/mouvement-agent/refuse-demande/"+id+"' data-toggle='tooltip' data-placement='top' title='Refuser' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-slash'></i> " +
            "        </a> ";
    }

    
    
    return btnDelete;
    
}