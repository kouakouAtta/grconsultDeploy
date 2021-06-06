/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/





$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();

    addElementToUCTable();
    addElementToTable()
    DelElementFromTablePC()
    DelElementFromTableUC()

    $('#enregistrer').hide();
    $('#tablePC').hide();
    $('#tableUC').hide();
    $('#zoneDeChoix').hide();

    rechercherMateriel();
    
});

function rechercherMateriel()
{
    $("#rechercher").on('click',function(){
        //$('ul').empty();

        $('#messageOk').find("ul").empty();
        document.getElementById("messageNOk").innerHTML= "";
        var idType=$("#typeMateriel").val();
        var numeroLivraison=$("#numeroLivraison").val();
        var donnees = {
            'idType' : idType,
            'numeroLivraison' : numeroLivraison,
        }
            rechercherBordereau();
            $.ajax({
                type:'POST',
                url:basePath + '/detailsTypeMaterielUcPc/getProdQteOnBordereauUCPC',
                data:donnees,
                async:true,
                dataType:'json',
                success:function(resp){
                  if(resp.data.length>0)
                  {
                    //alert(resp.data.length);
                    resp.data.forEach(element => {
                      console.log(JSON.stringify(element));
                      $('#messageOk').find("ul").append('<li class="text-success"> Marque : '+element.marque +'   ,   Modèle : '+element.modele+'   ,    Quantité : '+element.qte+' </li>');
                    });

                    $('#tablePC').show();
                      //$('#tableUC').hide();
                      $('#enregistrer').show();
                      $('#zoneDeChoix').show();
                  }
                  else
                  {
                    document.getElementById("messageNOk").innerHTML= "Aucun éléments trouvé";
                    $('#zoneDeChoix').hide();
                    $('#enregistrer').hide();
                    $('#tablePC').hide();
                  }
                  console.log('SUCCES de ajout de bordereau et matériels : '+JSON.stringify(resp));
                },
                error:function (err) {
                    //alert('vous avez cliquez sur rechercher : cas d\'erreur : '+JSON.stringify(err));
                      console.log('ERREUR de ajout de bordereau et matériels : '+JSON.stringify(err));
                }
              }
            );

    });
}

function rechercherBordereau()
{
    //alert(' Vous avez changé de valeur');
    //$('ul').empty();
      //recupereration des values des valeurs saisies et selectionnées
      var numeroLivraison=$("#numeroLivraison").val();
      var donnees = {
          'numeroLivraison' : numeroLivraison,
      }
      //rechercherBordereau();
          $.ajax({
              type:'POST',
              url:basePath + '/detailsTypeMaterielUcPc/getBordereauInfos',
              data:donnees,
              async:true,
              dataType:'json',
              success:function(resp){
                //const commandesByDay1 = resp;
                //alert('vous avez cliquez sur rechercher : cas de succès : '+JSON.stringify(resp));
                //document.getElementById("message").innerHTML =resp.message;
                document.getElementById("nLivraison").innerHTML =resp.numLivraison;
                document.getElementById("fournisseurRS").innerHTML =resp.raisonSocial;
                document.getElementById("nccFournisseur").innerHTML =resp.ncc;
                document.getElementById("contactFournisseur").innerHTML =resp.adresse;
                document.getElementById("nomLivreur").innerHTML =resp.nomLivreur;
                document.getElementById("contactLivreur").innerHTML =resp.telLivreur;
                console.log('Le bordereau récupérer est : '+JSON.stringify(resp));
                
                console.log('SUCCES de ajout de bordereau et matériels : '+JSON.stringify(resp));
              },
              error:function (err) {
                  alert('vous avez cliquez sur rechercher : cas d\'erreur : '+JSON.stringify(err));
                    console.log('ERREUR de ajout de bordereau et matériels : '+JSON.stringify(err));
              }
            }
          );
}

function addElementToUCTable()
{
  
  var valTextRam=$("#ram option:selected").text();
  var valTextRom=$("#rom option:selected").text();
  var valTextFrequence=$("#frequence option:selected").text();

  var valRam=$("#ram").val();
  var valRom=$("#rom").val();
  var valFrequence=$("#frequence").val();

  
        
    $("#ajouterTableUC").on('click',function(){
      //$('#tableUC').show();
      var ligneTab = "<tr>"+
      "<td><input name='ramUC[]' type='number' value='"+valRam+"' class='form-control' hidden='true'>"+valTextRam+"Go </td>"+
      "<td><input name='romUC[]' type='number' value='"+valRom+"' class='form-control' hidden='true'>"+valTextRom+"Go </td>"+
      "<td><input name='frequenceUC[]' type='number' value='"+valFrequence+"' class='form-control' hidden='true'>"+valTextFrequence+"Hz </td>"+
      "<td><input name='numeroSerieUC[]' type='textarea' value='' class='form-control'></td>"+
      "<td style='text-align: center;'>"+"<a href='' id='deleteUC' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
            $('#tableUC tbody').append(ligneTab);
     });
}

function addElementToTable()
{
        var valTextRam=$("#ram option:selected").text();
        var valTextRom=$("#rom option:selected").text();
        var valTextFrequence=$("#frequence option:selected").text();
        var valTextEcran=$("#tailleEcran option:selected").text();

        var valRam=$("#ram").val();
        var valRom=$("#rom").val();
        var valFrequence=$("#frequence").val();
        var valQte=$("#quantite").val();
        var valEcran=$("#tailleEcran option:selected").val();

    $("#ajouterTablePC").on('click',function(){
      //$('#tablePC').show();
            ///alert(valQte);
        
            var ligneTab = "<tr>"+
            "<td><input name='ramPC[]' type='number' value='"+valRam+"' class='form-control' hidden='true'>"+valTextRam+" Go </td>"+
            "<td><input name='romPC[]' type='number' value='"+valRom+"' class='form-control' hidden='true'>"+valTextRom+" Go </td>"+
            "<td><input name='frequencePC[]' type='number' value='"+valFrequence+"' class='form-control' hidden='true'>"+valTextFrequence+" Hz </td>"+
            "<td><input name='tailleEcran[]' type='number' value='"+valEcran+"' class='form-control' hidden='true'>"+valTextEcran+" '' </td>"+
            "<td><input name='numeroSeriePC[]' type='text' value='' class='form-control'></td>"+
            "<td style='text-align: center;'>"+"<a href='' id='deletePC' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
            $('#tablePC tbody').append(ligneTab);
     });
}


function DelElementFromTablePC()
{
    // code to read selected table row cell data (values).
    $("#tablePC").on('click','#deletePC',function(){
        // get the current row
        var currentRow=$(this).closest("tr"); 
        currentRow.remove();
        return false;
    });
        
}

function DelElementFromTableUC()
{
    // code to read selected table row cell data (values).
    $("#tablePC").on('click','#deletePC',function(){
        // get the current row
        var currentRow=$(this).closest("tr"); 
        currentRow.remove();
        return false;
    });
        
}


