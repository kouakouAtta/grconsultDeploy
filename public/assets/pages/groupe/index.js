/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#groupe-datatable").DataTable(
            {
                iDisplayLength: 10,
                sAjaxSource: basePath + '/ajaxservices/liste-des-groupes',
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
                    $('td:eq(0)', nRow).html(aData[1]);
                    $('td:eq(1)', nRow).html(formatDateMysql(aData[3]));

                }
            });})