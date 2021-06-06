$(function () {
        if($("#domaine").val()!=='autre'){
            $("#anotherDomaine").hide();
        }
        if($("#project").val()!=='autre'){
            $("#anotherProject").hide();
        }
    });
    
    $( "#domaine" ).change(function() {
        if($( "#domaine" ).val()==='autre'){
            $( "#anotherDomaine" ).show();
        }
        else{
            $( "#anotherDomaine" ).hide();
        }
    });
    
    $( "#project" ).change(function() {
        if($( "#project" ).val()==='autre'){
            $( "#anotherProject" ).show();
        }
        else{
            $( "#anotherProject" ).hide();
        }
    });