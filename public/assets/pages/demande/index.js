/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#demande-datatable").DataTable(
{
    iDisplayLength: 10,
    sAjaxSource: basePath + '/ajax/liste-des-demandes',
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
        $('td:eq(0)', nRow).html(aData[19]);
        $('td:eq(1)', nRow).html(aData[7]!=null?aData[7]:"-");
        $('td:eq(2)', nRow).html(aData[6]!=null?aData[6]:"-");
        $('td:eq(3)', nRow).html(aData[5]);
        $('td:eq(4)', nRow).html(aData[4]);
        $('td:eq(5)', nRow).html(formatDateMysql(aData[1]));
        $('td:eq(6)', nRow).html(getBadge(aData));
        $('td:eq(7)', nRow).html(getBtn(aData));
    }
});});

function getBadge(aData){
    if(aData[3] == null){
        badge =  '<span class="badge badge-soft-warning" style="font-size:12px;">En attente</span>';
    }
    if(aData[3] != null){
        badge = '<span class="badge badge-soft-info" style="font-size:12px;">En traitement</span>';
    }
    if(aData[13]!=null){
        badge = '<span class="badge badge-soft-success" style="font-size:12px;">En partance</span>';
    }
    if(aData[14]!=null){
        badge = '<span class="badge badge-soft-success" style="font-size:12px;">Réceptioné</span>';
    }
    if(aData[17]!=null){
        badge = '<span class="badge badge-soft-success" style="font-size:12px;">Attribué</span>';
    }
    
    return badge;
}

function getBtn(aData){
    
    var btnDelete = 
            "        <a href='"+basePath+"/demandes/voir-details/"+aData[0]+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    
    if(aData[15]==null && aData[12]!=null){
        btnDelete += 
                "        <button onclick='chargerBon("+aData[0]+")' data-toggle='tooltip' data-placement='top' title='Charger le bon de sortie' " +
                "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-download'></i> " +
                "        </button> ";
    }
    if(aData[15]!=null){
        btnDelete += 
                "        <button onclick='showBon(\""+aData[15]+"\")' data-toggle='tooltip' data-placement='top' title='Voir le bon de sortie' " +
                "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-file-text'></i> " +
                "        </button> ";
    }
    
    if(aData[16]==null && aData[15]!=null){
        btnDelete += 
                "        <a href='"+basePath+"/demandes/choisir-le-materiel/"+aData[0]+"' data-toggle='tooltip' data-placement='top' title='Attribuer des numéros de carton' " +
                "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
                "             <i class='feather-shopping-cart'></i> " +
                "        </a> ";
    }
    
    if(aData[13]==null && aData[16]!=null){
        btnDelete += 
                "        <a href='"+basePath+"/demandes/en-partance/"+aData[0]+"' data-toggle='tooltip' data-placement='top' title='Marquer en partance' " +
                "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
                "             <i class='fas fa-truck'></i> " +
                "        </a> ";
    }
    
    return btnDelete;
    
}

function chargerBon(id){
    $('#idDemande').val(id);
    $('#loadBon').modal();
}

function showBon(fileName){
    $('#bonSortie').attr('src', "../data/fichiers/bondesortie/"+fileName);
    $('#showBon').modal();
}

$(".dropify").dropify({
    messages:{
        default:"Faites glisser ou cliquer pour ajouter une image",
            replace:"Faites glisser ou cliquer pour modifier cette image",
            remove:"Supprimer",
            error:"Ooops, une erreur a été rencontrée."
        },
        error:{
            fileSize:"La taille du fichier est trop grande (1M max)."
        }
    }
);