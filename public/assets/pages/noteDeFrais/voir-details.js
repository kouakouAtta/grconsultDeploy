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
        text: "Entrez les motifs du refus de cette note de frais.",
        input:"text",inputAttributes:{autocapitalize:"off"},
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Refuser",
        cancelButtonText: "Annuler",
        closeOnConfirm: false,
        preConfirm:function(t){
            $.ajax({
            url: basePath+"/note-de-frais/refuser/"+$('#noteId').val(),
            type: "POST",
            data: {
                motif: t
            },
            dataType: "html",
            success: function () {
                swal("Done!", "It was succesfully deleted!", "success");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
            
    },
    })
});

$("#rembourser-alert").click(function(){
    Swal.fire({
        title: "Quel montant ?",
        text: "Entrez le montant remboursé pour cette note de frais.",
        input:"number",
        type: "success",
        showCancelButton:!0,
        confirmButtonColor: "#3cb371",
        confirmButtonText: "Payer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false,
        preConfirm:function(t){
            $.ajax({
                url: basePath+"/note-de-frais/rembourser/"+$('#noteId').val(),
                type: "POST",
                data: {
                    montant: t
                },
                dataType: "html",
                success: function () {
                    document.location.href = basePath+"/note-de-frais/voir-details/"+$('#noteId').val();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                }
            });
            
        },
    })
});
    
    