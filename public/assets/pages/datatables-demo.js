/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/


$(document).ready(function(){$("#basic-datatable").DataTable(
            {
                iDisplayLength: 10,
                sAjaxSource: basePath + '/services/liste-des-salaries',
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
                
                drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")},
            
                fnRowCallback: function(nRow, aData, iDisplayIndex){
                    $('td:eq(0)', nRow).html(aData[0]);
                    $('td:eq(1)', nRow).html(aData[1]);
                    $('td:eq(2)', nRow).html(aData[2]);
                    $('td:eq(3)', nRow).html(aData[3]);
                    $('td:eq(4)', nRow).html(aData[4]);
                    $('td:eq(5)', nRow).html(aData[5]);
                    $('td:eq(6)', nRow).html(aData[6]);
                    $('td:eq(7)', nRow).html(aData[7]);
                    $('td:eq(8)', nRow).html(aData[8]);

                }
            });})