/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#user-datatable").DataTable(
    {
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
    });
})