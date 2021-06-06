/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/





$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();

    $('#numeroSerie').hide();
    $('#labelNumeroSerie').hide();
    $('#enregistrer').hide();
    $("#rechercher").on('click',function(){
        
        //recupereration des values des valeurs saisies et selectionnées
        var numeroLivraison=$("#numeroLivraison option:selected").text();
        var donnees = {
            'numeroLivraison' : numeroLivraison,
        }
        $('#commercial_mentor').hide();
        if(numeroLivraison.trim () =='')
        {
            //alert("Saisissez une valeur s'il vous plaît ");
            Swal.fire('Saisissez le numéro du bordereau s\'il vous plaît');
        }
        else
        {
            $.ajax({
                type:'POST',
                url:basePath + '/imprimantes/getProdQteOnBordereau',
                data:donnees,
                async:true,
                dataType:'json',
                success:function(resp){
                  //const commandesByDay1 = resp;
                  //alert('vous avez cliquez sur rechercher : cas de succès : '+JSON.stringify(resp));
                  document.getElementById("message").innerHTML =resp.message;
                  console.log('La Qte récupérer est : '+resp.data.quantite);
                  if(resp.data.quantite>0)
                    {
                        $('#numeroSerie').show();
                        $('#labelNumeroSerie').show();
                        $('#enregistrer').show();
                    }
                    else
                    {
                        $('#numeroSerie').hide();
                        $('#labelNumeroSerie').hide();
                        $('#enregistrer').hide();
                    }
                  console.log('SUCCES de ajout de bordereau et materiels : '+resp);
                },
                error:function (err) {
                    alert('vous avez cliquez sur rechercher : cas d\'erreur : '+JSON.stringify(err));
                      console.log('ERREUR de ajout de bordereau et materiels : '+err);
                }
              }
            );
        }
         
     
     });
   
});


