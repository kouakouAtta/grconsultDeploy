/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Advanced Plugins
*/
$(document).ready(function(){
    
    nbreQuestion = $('#nbreQuestion').val();
    
    for(i=1; i<=nbreQuestion; i++){
        $('#div'+i).hide();
    }
    $('#questions').hide();
    $('#terminer').hide();
    $('#precedent1').attr('style','pointer-events: none;cursor: default;');
    $('#suivant'+nbreQuestion).attr('style','pointer-events: none;cursor: default;');
    $(document).on("keydown", disableF5);
});

var duree = parseInt($('#duree').val());

var actuel = new Date().getTime();
var countDownDate = new Date(actuel+(duree)*60000);
countDownDate.setSeconds(countDownDate.getSeconds()+4);
// Update the count down every 1 second
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

function validateExamen(){
    $.ajax({
        url: basePath+"/ajaxelearning/validate-examen",
        type: "POST",
        data: {
            id: $('#evaluation').val()
        },
        dataType: "html",
        success: function () {
            console.log('success');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('error');
        }
    });
}

function switchQuestion(j){
    $('#div'+j).show();
    for(i=1; i<=nbreQuestion; i++){
        if(j!=i)
            $('#div'+i).hide();
    }
    
    if(j==5)
        $('#terminer').show();
    else
        $('#terminer').hide();
}

function demarrer(){
    $('#initialisation-card').hide();
    $('#questions').show();
    $('#div1').show();
    
    var x = setInterval(function() {
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        minutes = (minutes < 10) ? '0' + minutes : minutes;

        seconds = (seconds < 10) ? '0' + seconds : seconds;
      // Display the result in the element with id="demo"
        $(".compteur").html(minutes + " min " + seconds + " s");

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          $( "#terminer" ).trigger( "click" );
        }
    }, 1000);
}