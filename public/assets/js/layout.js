/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/

var time = 24 * 60 * 60 * 1000;
$(document).ready(function(){
    setTimeout(sendAnivSms(), time);
});

function sendAnivSms(){
    
    $.ajax({
        url: basePath + '/ajaxservices/envoi-sms',
        type: 'post',
        success: function(response){
         // Perform operation on the return value
         //alert(response);
        },
        complete:function(data){
           setTimeout(sendAnivSms(), time);
        }
    });
}