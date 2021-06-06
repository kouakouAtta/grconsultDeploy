/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#type-recours-datatable").DataTable(
{
    iDisplayLength: 10,
    oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
});});

function getBtn(id){
    
    var btnDelete = 
            "        <a href='"+basePath+"/salarie/voir-details/"+id+"' data-toggle='tooltip' data-placement='top' title='Voir les détails' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-eye'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/salarie/modifier/"+id+"' data-toggle='tooltip' data-placement='top' title='Valider' " +
            "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-check'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/salarie/supprimer/"+id+"' data-toggle='tooltip' data-placement='top' title='Refuser' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-slash'></i> " +
            "        </a> ";
    
    return btnDelete;
    
}