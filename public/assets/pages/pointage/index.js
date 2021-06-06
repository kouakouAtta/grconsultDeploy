/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/
$(document).ready(function(){$("#pointage-datatable").DataTable(
            {
                iDisplayLength: 10,
                sAjaxSource: basePath + '/ajaxservices/liste-des-pointages-par-agent',
                sServerMethod: 'post',
                aaSorting: [[1, 'desc']],
                fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
                    oSettings.jqXHR = $.ajax({
                      "dataType": 'json',
                      "type": "POST",
                      "url": sSource,
                      "success": fnCallback
                })},
                oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
                fnRowCallback: function(nRow, aData, iDisplayIndex){
                    $('td:eq(0)', nRow).html(formatDateMysql(aData[1]));
                    $('td:eq(1)', nRow).html(formatTimeMysql(aData[1]));
                    if(aData[2] == "pas encore"){
                        $('td:eq(2)', nRow).html("Pas encore pointée");
                    }
                    else{
                        $('td:eq(2)', nRow).html(formatTimeMysql(aData[2]));
                    }
                }
            });})