/*

 Template Name: Scoxe - Admin & Dashboard Template

 Author: Myra Studio

 File: Sweet Alers

*/





//Basic

var timerInterval;

$("#refuser-alert").click(function(){

    Swal.fire({

        title: "Pourquoi ?",

        text: "Entrez les motifs du refus de ce mouvement.",

        input:"text",inputAttributes:{autocapitalize:"off"},

        type: "error",

        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Refuser",

        cancelButtonText: "Annuler",

        closeOnConfirm: false,

        preConfirm:function(t){

            $.ajax({

            url: basePath+"/mouvement-agent/refuse-demande/"+$('#mvtId').val(),

            type: "POST",

            data: {

                motif: t

            },

            dataType: "html",

            success: function () {

                //swal("Done!", "It was succesfully deleted!", "success");

                document.location.href=basePath+"/mouvement-agent/voir-details/"+$('#mvtId').val();

            },

            error: function (xhr, ajaxOptions, thrownError) {

                swal("Error deleting!", "Please try again", "error");

            }

        });

            

    },

    })

});



$("#signer-alert").click(function(){

    Swal.fire({

        title: "Quel est la date d'effet ?",

        text: "Entrez la date d'effet.",

        html:"<input id='date' type='date' class='form-control'>",

        type: "success",

        showCancelButton:!0,

        confirmButtonColor: "#3cb371",

        confirmButtonText: "Valider",

        cancelButtonText: "Annuler",

        closeOnConfirm: false,

        preConfirm:function(t){

            $.ajax({

                url: basePath+"/mouvement-agent/signe-demande/"+$('#mvtId').val(),

                type: "POST",

                data: {

                    dateffet: $('#date').val()

                },

                dataType: "html",

                success: function () {

                    //swal("Done!", "It was succesfully deleted!", "success");

                    document.location.href=basePath+"/mouvement-agent/voir-details/"+$('#mvtId').val();
                },

                error: function (xhr, ajaxOptions, thrownError) {

                    swal("Error deleting!", "Please try again", "error");

                }

            });

            

        },

    })

});

    

    