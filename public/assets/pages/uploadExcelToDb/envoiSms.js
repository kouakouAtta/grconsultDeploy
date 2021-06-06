/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#message").summernote()(
{
    height: 100
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
            "             <i class='feather-edit'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a href='"+basePath+"/salarie/supprimer/"+id+"' data-toggle='tooltip' data-placement='top' title='Refuser' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-trash'></i> " +
            "        </a> ";
    
    return btnDelete;
    
}