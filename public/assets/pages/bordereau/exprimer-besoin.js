/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/

i = 1;

$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();
    
   
});

function ajouterDetail(){
    exist = false;
    
    if($('#quantiteVoulue').val() == ""){
        $('#errorVal').attr("hidden", false);
    }
    else{
        for(j=1; j<7; j++){
            if($('#typeMateriel'+j).val() == $('#typeMateriel').val()){
                $('#quantiteVoulue'+j).val(parseInt($('#quantiteVoulue'+j).val()) + parseInt($('#quantiteVoulue').val()));
                $('#textQuantiteVoulue'+j).text($('#quantiteVoulue'+j).val());
                exist = true;
            }
        }
        if(!exist){
            
            $('#typeMateriel'+i).val($('#typeMateriel').val());
            $('#quantiteVoulue'+i).val($('#quantiteVoulue').val());

            $('#textTypeMateriel'+i).text($("#typeMateriel option:selected").html());
            $('#textQuantiteVoulue'+i).text($('#quantiteVoulue').val());

            $('#ligne'+i).attr("hidden", false);
        }
        $('#errorVal').attr("hidden", true);
        i++;
        $('#quantiteVoulue').val("");
    }
    
}

function deleteDetail(i){
    $('#typeMateriel'+i).val("");
    $('#quantiteVoulue'+i).val("");

    $('#textTypeMateriel'+i).text("");
    $('#textQuantiteVoulue'+i).text("");

    $('#ligne'+i).attr("hidden", true);
}