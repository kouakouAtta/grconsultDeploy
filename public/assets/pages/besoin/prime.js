/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){
    $("#primes-datatable").DataTable(
    {
        sDom : "<'top row'<'col-sm-2'l><'col-sm-7 ctnCmd'><'col-sm-3'f> >rt<'bottom'ip<'clear'>>",
        iDisplayLength: 10,
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'}

    });
});
