/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();
    
    $('[data-toggle="input-mask"]').each(function(a,e){
        var t=$(e).data("maskFormat"),n=$(e).data("reverse");
        null!=n?$(e).mask(t,{reverse:n}):$(e).mask(t);});

});