/*
 Template Name: Scoxe - Admin & Dashboard Template
 Author: Myra Studio
 File: Datatables
*/





$(document).ready(function(){
    
    $('[data-toggle="select2"]').select2();

    soumissionFormulaire();
    ecouteShowCarateristique();
    $('#enregistrer').hide();
    $('#tablePC').hide();
    $('#tableUC').hide();
    $('#materiel-type-datatable').hide();
    $('#zoneDeChoix').hide();
    //$('#zoneIdentique').hide();
    $('#zoneDifferente').hide();
    $('#ajouterLigne').hide();

    var objet= [    {'code':'UC'},
                    {'code':'EC'},
                    {'code':'HDE'},
                    {'code':'PC'},
                    {'code':'ON'},
                    {'code':'SW'},
                  ];
    cacherZoneTableau(objet,'Differente');
    /*var objet= [    {'code':'UC'},
                    {'code':'EC'},
                    {'code':'PC'},
                    {'code':'HDE'},
                    {'code':'SW'},
                    {'code':'Autre'}
                  ];
    cacherZoneTableau(objet,'Show');*/

    rechercherMateriel();
    ajouteBordereauIdEtMaterielIdAModal();
    ecouterAddClickRadioNon();
    ecouterDelClickRadioNon();
    //radioButtonSwitch()
});

function rechercherMaterielSansClick(donnee)
{
  $.ajax({
      type:'POST',
      url:basePath + '/detailsTypeMaterielUcPc/getProdQteOnBordereauUCPC',
      data:donnee,
      async:true,
      dataType:'json',
      success:function(resp){
        if(resp.data.length>0)
        {
          console.log('les données reçues  : '+JSON.stringify(resp));
          $('#materiel-type-datatable').find('tbody tr').remove();
          //alert(resp.data.length);
          resp.data.forEach(element => {
            console.log(JSON.stringify(element));
            laLigne = '<tr class="text-secondary text-center" resteAttr="'+(parseFloat(element.qte)-parseFloat(element.qteSaisie))+'" dejaSaisieAttr="'+element.qteSaisie+'" typeMaterielCode="'+element.typeMaterielCode+'" numBordereau="'+element.codeBordereau+'" materielId="'+element.id+'"> <td>'+element.typeLibelle+'</td> <td>'+element.marque +'</td><td> '+element.modele+' </td><td>'+element.qte+'</td>';
            if(element.qteSaisie == parseFloat(element.qte))
              {
                //console.log('je suis if de rechercherMateriel')
                laLigne  = laLigne + '<td colspan="2"><button id="showDetails" type="button" class="btn btn-rounded btn-primary btn-sm waves-effect waves-light">'+
                    '<i class="feather-eye"></i>'+
                '</button></td> </tr>';
              }
              else
              {//console.log('je suis else de rechercherMateriel')
                if(parseFloat(element.qteSaisie)!=0 && parseFloat(element.qteSaisie) < parseFloat(element.qte))
                  {
                    //console.log('je suis else if de rechercherMateriel')
                    laLigne  = laLigne + '<td colspan="1"><button id="showDetails" type="button" class="btn btn-rounded btn-primary btn-sm waves-effect waves-light">'+
                    '<i class="feather-eye"></i>'+
                    '</button></td><td colspan="1"><button id="ajouterDetails" type="button" class="btn btn-rounded btn-success btn-sm waves-effect waves-light">'+
                    '<i class="feather-plus-circle "></i> '+
                    '</button></td> </tr>';
                  }
                  else{
                    //console.log('je suis else else de rechercherMateriel')
                    laLigne  = laLigne + '<td colspan="2"><button id="ajouterDetails" type="button" class="btn btn-rounded btn-success btn-sm waves-effect waves-light">'+
                    '<i class="feather-plus-circle "></i>'+
                    '</button></td> </tr>';
                  }
                //laLigne  = laLigne + '<button id="ajouterDetails" type="button" class="btn btn-rounded btn-success btn-sm waves-effect waves-light">'+
                //'<i class="feather-plus-circle "></i> '+
                //'</button></td> </tr>';
              }
            $('#materiel-type-datatable tbody').append(laLigne);
            //data-toggle="modal" data-target="#modalDetailsMateriel"
            //alert(laLigne);
            //$('#messageOk').find("materiel-type-datatable body").append(laLigne);
          });
          //On présente le tableau 
          $('#materiel-type-datatable').show();

          //$('#tablePC').show();
          //$('#tableUC').hide();
            $('#enregistrer').show();
            //$('#zoneDeChoix').show();
        }
        else
        {
          document.getElementById("messageNOk").innerHTML= "Aucun élément trouvé";
          $('#zoneDeChoix').hide();
          $('#enregistrer').hide();
          $('#tablePC').hide();
          $('#materiel-type-datatable').hide();
        }
        console.log('SUCCES de ajout de bordereau et matériels : '+JSON.stringify(resp));
      },
      error:function (err) {
          //alert('vous avez cliquez sur rechercher : cas d\'erreur : '+JSON.stringify(err));
            console.log('ERREUR de ajout de bordereau et matériels : '+JSON.stringify(err));
      }
    }
  );
}
function rechercherMateriel()
{   
    $("#rechercher").on('click',function(){
            //$('ul').empty();
            //$('#messageOk').find("ul").empty();
            document.getElementById("messageNOk").innerHTML= "";
            //var idType=$("#typeMateriel").val();
            var numeroLivraison=$("#numeroLivraison").val();
            var donnees = {
                //'idType' : idType,
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
                    console.log('les données reçues  : '+JSON.stringify(resp));
                    $('#materiel-type-datatable').find('tbody tr').remove();
                    //alert(resp.data.length);
                      resp.data.forEach(element => {
                      console.log(JSON.stringify(element));
                      laLigne = '<tr class="text-secondary text-center" resteAttr="'+(parseFloat(element.qte)-parseFloat(element.qteSaisie))+'" dejaSaisieAttr="'+element.qteSaisie+'" typeMaterielCode="'+element.typeMaterielCode+'" numBordereau="'+element.codeBordereau+'" materielId="'+element.id+'"> <td>'+element.typeLibelle+'</td> <td>'+element.marque +'</td><td> '+element.modele+' </td><td>'+element.qte+'</td>';
                      
                      if(element.qteSaisie == parseFloat(element.qte))
                      {
                        //console.log('je suis if de rechercherMateriel')
                        laLigne  = laLigne + '<td colspan="2"><button id="showDetails" type="button" class="btn btn-rounded btn-primary btn-sm waves-effect waves-light">'+
                            '<i class="feather-eye"></i>'+
                        '</button></td> </tr>';
                      }
                      else
                      {//console.log('je suis else de rechercherMateriel')
                        if(parseFloat(element.qteSaisie)!=0 && parseFloat(element.qteSaisie) < parseFloat(element.qte))
                          {
                            //console.log('je suis else if de rechercherMateriel')
                            laLigne  = laLigne + '<td colspan="1"><button id="showDetails" type="button" class="btn btn-rounded btn-primary btn-sm waves-effect waves-light">'+
                            '<i class="feather-eye"></i>'+
                            '</button></td><td colspan="1"><button id="ajouterDetails" type="button" class="btn btn-rounded btn-success btn-sm waves-effect waves-light">'+
                            '<i class="feather-plus-circle "></i> '+
                            '</button></td> </tr>';
                          }
                          else{
                            //console.log('je suis else else de rechercherMateriel')
                            laLigne  = laLigne + '<td colspan="2"><button id="ajouterDetails" type="button" class="btn btn-rounded btn-success btn-sm waves-effect waves-light">'+
                            '<i class="feather-plus-circle "></i> '+
                            '</button></td> </tr>';
                          }
                        //laLigne  = laLigne + '<button id="ajouterDetails" type="button" class="btn btn-rounded btn-success btn-sm waves-effect waves-light">'+
                        //'<i class="feather-plus-circle "></i> '+
                        //'</button></td> </tr>';
                      }
                      $('#materiel-type-datatable tbody').append(laLigne);
                      //data-toggle="modal" data-target="#modalDetailsMateriel"
                      //alert(laLigne);
                      //$('#messageOk').find("materiel-type-datatable body").append(laLigne);
                    });
                    //On présente le tableau 
                    $('#materiel-type-datatable').show();

                    //$('#tablePC').show();
                    //$('#tableUC').hide();
                      $('#enregistrer').show();
                      //$('#zoneDeChoix').show();
                  }
                  else
                  {
                    document.getElementById("messageNOk").innerHTML= "Aucun élément trouvé";
                    $('#zoneDeChoix').hide();
                    $('#enregistrer').hide();
                    $('#tablePC').hide();
                    $('#materiel-type-datatable').hide();
                  }
                  console.log('SUCCES de ajout de bordereau et matériels : '+JSON.stringify(resp));
                },
                error:function (err) {
                    //alert('vous avez cliquez sur rechercher : cas d\'erreur : '+JSON.stringify(err));
                      console.log('ERREUR de ajout de bordereau et matériels : '+JSON.stringify(err));
                }
              }
            );

            //ecouteShowCarateristique();

    });
    
}

function ajouteBordereauIdEtMaterielIdAModal()
{
  $("#materiel-type-datatable").on('click','#ajouterDetails',function(){
    //alert('vous avez cliquez')
    var currentRow=$(this).closest("tr");
    document.getElementById('codeBordereau').value = currentRow.attr('numBordereau');
    document.getElementById('codeMateriel').value = currentRow.attr('materielId');
    document.getElementById('DetailsQteDejSaisie').innerHTML = currentRow.attr('dejaSaisieAttr');
    document.getElementById('DetailsQteResteASaisir').innerHTML = currentRow.attr('resteAttr');
    document.getElementById('codeTypeMateriel').value = currentRow.attr('typeMaterielCode');
    document.getElementById('DetailsQte').innerHTML = currentRow.find('td:eq(3)').text() ;
    radioButtonSwitch(currentRow.attr('typeMaterielCode'));
    $("#modalDetailsMateriel").modal('show');

  });

}

function ecouterAddClickRadioNon()
{
  $("#ajouterLigneBTN").on('click',function(){
    var leCode = $('#codeTypeMateriel').val();
    var lesNumeSerie = $("#numeroSerieSelect").val();
    if(lesNumeSerie.trim () =='')
    {
      //alert('Veuillez saisir le(s) numéro(s) de série s\'il vous plaît');
      Swal.fire('Veuillez saisir le(s) numéro(s) de série s\'il vous plaît');
    }
    else
    {
      addElementToTable(leCode);
    }

  });
}

function ecouterDelClickRadioNon()
{
  $("#ajouterLigneBTN").on('click',function(){
    var leCode = $('#codeTypeMateriel').val();
    DelElementFromTable(leCode);
  });
}

//zone = {Differente, Show}
function cacherZoneTableau(obj,zone)
{
    obj.forEach(element => {
      $('#tabZone'+zone+element.code).hide();
    });
}
function cacherZoneTableauSaufCode(obj,zone,lecode)
{
  obj.forEach(element => {
    if(element.code == lecode)
      {
        $('#tabZone'+zone+element.code).show();
      }
    else
    {
      $('#tabZone'+zone+element.code).hide();
    }
  });
}
function removeZoneTableau(obj)
{
    obj.forEach(element => {
      $('#tabZoneDifferente'+element.code).hide();
    });
}

function cacherElementDeChoix(code)
{
    if(code=='PC')
      {
        $('#zoneEcran').show();
        $('#zonePuissance').hide(); 
        $('#zoneFrequence').show();
        $('#zoneNbrPort').hide();
        $('#zoneRom').show(); 
        $('#zoneRam').show(); 
    }
    if(code=='UC')
    {
      $('#zoneEcran').hide();
      $('#zonePuissance').hide(); 
      $('#zoneFrequence').show();
      $('#zoneNbrPort').hide();
      $('#zoneRom').show(); 
      $('#zoneRam').show(); 
    }
    if(code=='EC' || code=='ES')
    {
      $('#zoneEcran').show();
      $('#zonePuissance').hide(); 
      $('#zoneFrequence').hide();
      $('#zoneNbrPort').hide();
      $('#zoneRom').hide(); 
      $('#zoneRam').hide();
    }
    if(code=='HDE' || code=='CUB')
    {
      $('#zoneEcran').hide();
      $('#zonePuissance').hide(); 
      $('#zoneFrequence').hide();
      $('#zoneNbrPort').hide();
      $('#zoneRom').show(); 
      $('#zoneRam').hide();      
    }
    if(code=='ON')
    {
      $('#zoneEcran').hide();
      $('#zonePuissance').show(); 
      $('#zoneFrequence').hide();
      $('#zoneNbrPort').hide(); 
      $('#zoneRom').hide(); 
      $('#zoneRam').hide();      
    }
    if(code=='SW')
    {
      $('#zoneEcran').hide();
      $('#zoneNbrPort').show();
      $('#zonePuissance').hide(); 
      $('#zoneFrequence').hide();
      $('#zoneRom').hide(); 
      $('#zoneRam').hide();       
    }
}

function montrerZoneTableau(code)
{
    $('#tabZoneDifferente'+code).show();
}


function radioButtonSwitch(codeTypeMateriel)
{
  cacherElementDeChoix(codeTypeMateriel);
  if(codeTypeMateriel!='PC' && codeTypeMateriel!='UC' && codeTypeMateriel!='EC' && codeTypeMateriel!='ES' && codeTypeMateriel!='SW' && codeTypeMateriel!='HDE' && codeTypeMateriel!='CUB' && codeTypeMateriel!='ON')
  {
    $("#zoneMessageEtRadio").hide();
    $("#zoneIdentiqueChoix").hide();
    $("#zoneIdentiqueNumeroSerie").show();
    $('#ajouterLigne').hide();
    var objet= [{'code':'UC'},
                {'code':'PC'},
                {'code':'EC'},
                {'code':'SW'},
                {'code':'HDE'}
              ];
      removeZoneTableau(objet);
  }
  else
  {
    if(codeTypeMateriel=='PC')
    {  var objet= [ {'code':'UC'},
                    {'code':'EC'},
                    {'code':'SW'},
                    {'code':'HDE'}
                  ];
      cacherZoneTableau(objet,'Differente');
      montrerZoneTableau('PC');
      $("#zoneMessageEtRadio").show();
      $("#zoneIdentiqueChoix").show();
      $("#zoneIdentiqueNumeroSerie").show();
    }
    if(codeTypeMateriel=='UC')
    {
      var objet= [  {'code':'PC'},
                    {'code':'EC'},
                    {'code':'SW'},
                    {'code':'HDE'},
                    {'code':'ON'}
                  ];
      cacherZoneTableau(objet,'Differente');
      montrerZoneTableau('UC');
      $("#zoneMessageEtRadio").show();
      $("#zoneIdentiqueChoix").show();
      $("#zoneIdentiqueNumeroSerie").show();
    }
    if(codeTypeMateriel=='EC' || codeTypeMateriel=='ES' )
    {
      var objet= [  {'code':'UC'},
                    {'code':'PC'},
                    {'code':'SW'},
                    {'code':'HDE'},
                    {'code':'ON'}
                  ];
      cacherZoneTableau(objet,'Differente');
      montrerZoneTableau('EC');
      $("#zoneMessageEtRadio").show();
      $("#zoneIdentiqueChoix").show();
      $("#zoneIdentiqueNumeroSerie").show();
    }
    if(codeTypeMateriel=='SW')
    {
      var objet= [  {'code':'UC'},
                    {'code':'EC'},
                    {'code':'PC'},
                    {'code':'HDE'},
                    {'code':'ON'}
                  ];
      cacherZoneTableau(objet,'Differente');
      montrerZoneTableau('SW');
      $("#zoneMessageEtRadio").show();
      $("#zoneIdentiqueChoix").show();
      $("#zoneIdentiqueNumeroSerie").show();
    }
    if(codeTypeMateriel=='ON')
    {
      var objet= [  {'code':'UC'},
                    {'code':'EC'},
                    {'code':'PC'},
                    {'code':'HDE'},
                    {'code':'SW'}
                  ];
      cacherZoneTableau(objet,'Differente');
      montrerZoneTableau('SW');
      $("#zoneMessageEtRadio").show();
      $("#zoneIdentiqueChoix").show();
      $("#zoneIdentiqueNumeroSerie").show();
    }
    if(codeTypeMateriel=='HDE' || codeTypeMateriel=='CUB')
    {
      var objet= [  {'code':'UC'},
                    {'code':'EC'},
                    {'code':'PC'},
                    {'code':'SW'},
                    {'code':'ON'}
                  ];
      cacherZoneTableau(objet,'Differente');
      montrerZoneTableau('HDE');
      $("#zoneMessageEtRadio").show();
      $("#zoneIdentiqueChoix").show();
      $("#zoneIdentiqueNumeroSerie").show();
    }
  }
  //Enlever ce code ci-dessous pour activer celui commenté  par /* ... */ si vous voulez activer les fonctionnalités du radio bouton
  $('#zoneDifferente').hide();
  var objet= [{'code':'UC'},
                {'code':'PC'},
                {'code':'EC'},
                {'code':'SW'},
                {'code':'HDE'},
                {'code':'ON'}
              ];
      removeZoneTableau(objet);
      $('#zoneDifferente').show();
      if(codeTypeMateriel=='PC' || codeTypeMateriel =='UC' || codeTypeMateriel == 'EC' || codeTypeMateriel =='ES' || codeTypeMateriel =='HDE' || codeTypeMateriel =='ON' || codeTypeMateriel =='CUB' || codeTypeMateriel =='SW')
        {
          //montrer le bouton
          $('#ajouterLigne').show();
        }
        //cacher le bouton
        else
        {
          $('#ajouterLigne').hide();
        }
      montrerZoneTableau(codeTypeMateriel);
  //Au click du bouton radion dont le nom est ouinon
  /*$("input:radio[name=ouinon]").on('click',function(){
    var laValeurSelectionnee = $("input[name=ouinon]:checked").val();
    if(laValeurSelectionnee=='OUI')
    {
      //alert('oui')
      //$('#zoneIdentique').show();
      $('#zoneDifferente').hide();
      $('#ajouterLigne').hide();
      //cacherElementDeChoix(codeTypeMateriel);
      var objet= [{'code':'UC'},
                {'code':'PC'},
                {'code':'EC'},
                {'code':'SW'},
                {'code':'HDE'}
              ];
      removeZoneTableau(objet);
    }
    else
    {
      //alert('non')
      var objet= [{'code':'UC'},
                {'code':'PC'},
                {'code':'EC'},
                {'code':'SW'},
                {'code':'HDE'}
              ];
      removeZoneTableau(objet);
      $('#zoneDifferente').show();
      $('#ajouterLigne').show();
      montrerZoneTableau(codeTypeMateriel);
      //cacherElementDeChoix(codeTypeMateriel);
      //$('#zoneIdentique').hide();
    }
  });*/

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
                  //alert('vous avez cliquez sur rechercher : cas d\'erreur : '+JSON.stringify(err));
                    console.log('ERREUR de ajout de bordereau et matériels : '+JSON.stringify(err));
              }
            }
          );
}

/*function addElementToUCTable()
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
}*/

function addElementToTable(code)
{
    if(code=='PC')
    {
      var valTextEcran=$("#tailleEcranSelect option:selected").text();
      var valTextRam=$("#ramSelect option:selected").text();
      var valTextRom=$("#romSelect option:selected").text();
      var valTextFrequence=$("#frequenceSelect option:selected").text();
      
      var valEcran=$("#tailleEcranSelect").val();
      var valRam=$("#ramSelect").val();
      var valRom=$("#romSelect").val();
      var valFrequence=$("#frequenceSelect").val();
      var numeroSerie= $("#numeroSerieSelect").val();
      
      //alert('je suis entré dans la zone PC ; val ram : ' + valRam+' text ram: '+valTextRam);
      
      var ligneTab = "<tr>"+
      "<td><input name='ram[]' type='number' value='"+valRam+"' class='form-control' hidden='true'>"+valTextRam+" Go </td>"+
      "<td><input name='rom[]' type='number' value='"+valRom+"' class='form-control' hidden='true'>"+valTextRom+" Go </td>"+
      "<td><input name='frequence[]' type='number' value='"+valFrequence+"' class='form-control' hidden='true'>"+valTextFrequence+" Hz </td>"+
      "<td><input name='tailleEcran[]' type='number' value='"+valEcran+"' class='form-control' hidden='true'>"+valTextEcran+" '' </td>"+
      "<td><textarea name='numeroSerie[]' value='"+numeroSerie+"' class='form-control'>"+numeroSerie+"</textarea></td>"+
      "<td style='text-align: center;'>"+"<a href='' id='delete"+code+"' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
      $('#tabZoneDifferente'+code+' tbody').append(ligneTab);
      //On vide le champs de saisie des numéro de série
      $("#numeroSerieSelect").val("");
    }
    if(code=='UC')
    {
      var valTextRam=$("#ramSelect option:selected").text();
      var valTextRom=$("#romSelect option:selected").text();
      var valTextFrequence=$("#frequenceSelect option:selected").text();
     
      var valRam=$("#ramSelect").val();
      var valRom=$("#romSelect").val();
      var valFrequence=$("#frequenceSelect").val();
      var numeroSerie= $("#numeroSerieSelect").val();
      

      //alert('je suis entré dans la zone UC ; val ram : ' + valRam+' text ram: '+valTextRam);

      var ligneTab = "<tr>"+
      "<td><input name='ram[]' type='number' value='"+valRam+"' class='form-control' hidden='true'>"+valTextRam+" Go </td>"+
      "<td><input name='rom[]' type='number' value='"+valRom+"' class='form-control' hidden='true'>"+valTextRom+" Go </td>"+
      "<td><input name='frequence[]' type='number' value='"+valFrequence+"' class='form-control' hidden='true'>"+valTextFrequence+" Hz </td>"+
      "<td><textarea name='numeroSerie[]' value='"+numeroSerie+"' class='form-control'>"+numeroSerie+"</textarea></td>"+
      "<td style='text-align: center;'>"+"<a href='' id='delete"+code+"' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
      $('#tabZoneDifferente'+code+' tbody').append(ligneTab);
      //On vide le champs de saisie des numéro de série
      $("#numeroSerieSelect").val("");
    }
    if(code=='EC' || code =='ES')
    {
      var valTextEcran=$("#tailleEcranSelect option:selected").text();
     
      var valEcran=$("#tailleEcranSelect").val();
      var numeroSerie= $("#numeroSerieSelect").val();
      //alert('je suis entré dans la zone EC ; val : ' + valEcran+' text : '+valTextEcran);

      var ligneTab = "<tr>"+
      "<td><input name='tailleEcran[]' type='number' value='"+valEcran+"' class='form-control' hidden='true'>"+valTextEcran+" '' </td>"+
      "<td><textarea name='numeroSerie[]' value='"+numeroSerie+"' class='form-control'>"+numeroSerie+"</textarea> </td>"+
      "<td style='text-align: center;'>"+"<a href='' id='delete"+code+"' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
      $('#tabZoneDifferente'+code+' tbody').append(ligneTab);
      //On vide le champs de saisie des numéro de série
      $("#numeroSerieSelect").val("");
    }
    if(code=='SW')
    {
      var valTextNbrPorts=$("#nbrPortSelect option:selected").text();     
      
      var valNbrPorts=$("#nbrPortSelect").val();
      var numeroSerie= $("#numeroSerieSelect").val();

      //alert('je suis entré dans la zone SW; val : ' + valPuissance+' text : '+valTextPuissance);

      var ligneTab = "<tr>"+
      "<td><input name='nbrPort[]' type='number' value='"+valNbrPorts+"' class='form-control' hidden='true'>"+valTextNbrPorts+" </td>"+
      "<td><textarea name='numeroSerie[]' value='"+numeroSerie+"' class='form-control'>"+numeroSerie+"</textarea> </td>"+
      "<td style='text-align: center;'>"+"<a href='' id='delete"+code+"' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
      $('#tabZoneDifferente'+code+' tbody').append(ligneTab);
      //On vide le champs de saisie des numéro de série
      $("#numeroSerieSelect").val("");
    }
    if(code=='ON')
    {
      var valTextPuissance=$("#puissanceSelect option:selected").text();     
      
      var valPuissance=$("#puissanceSelect").val();
      var numeroSerie= $("#numeroSerieSelect").val();

      //alert('je suis entré dans la zone ON; val : ' + valPuissance+' text : '+valTextPuissance);

      var ligneTab = "<tr>"+
      "<td><input name='puissance[]' type='number' value='"+valPuissance+"' class='form-control' hidden='true'>"+valTextPuissance+" </td>"+
      "<td><textarea name='numeroSerie[]' value='"+numeroSerie+"' class='form-control'>"+numeroSerie+"</textarea></td>"+
      "<td style='text-align: center;'>"+"<a href='' id='delete"+code+"' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
      $('#tabZoneDifferente'+code+' tbody').append(ligneTab);
      //On vide le champs de saisie des numéro de série
      $("#numeroSerieSelect").val("");
    }
    if(code=='HDE' || code == 'CUB')
    {
      var valTextRom=$("#romSelect option:selected").text();
      var valRom=$("#romSelect").val();
      var numeroSerie= $("#numeroSerieSelect").val();
      //alert('je suis entré dans la zone HDE; val : ' + valRom+' text : '+valTextRom);

      var ligneTab = "<tr>"+
      "<td><input name='rom[]' type='number' value='"+valRom+"' class='form-control' hidden='true'>"+valTextRom+" Go </td>"+
      "<td><textarea name='numeroSerie[]'  value='"+numeroSerie+"' class='form-control'>"+numeroSerie+"</textarea></td>"+
      "<td style='text-align: center;'>"+"<a href='' id='delete"+code+"' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a></td></tr>";
      $('#tabZoneDifferente'+code+' tbody').append(ligneTab);
      //On vide le champs de saisie des numéro de série
      $("#numeroSerieSelect").val("");
    }
}


function DelElementFromTable(code)
{
    // code to read selected table row cell data (values).
    $("#tabZoneDifferente"+code).on('click','#delete'+code,function(){
        // get the current row
        var currentRow=$(this).closest("tr"); 
        currentRow.remove();
        return false;
    });
        
}
//Ecoute le click sur le bouton voir
function ecouteShowCarateristique()
{
    // code to read selected table row cell data (values).
    $("#materiel-type-datatable").on('click','#showDetails',function(){
    //$("#showDetails").on('click',function(){
      //alert('Vous avez cliquez sur  : showDetails');
      //on cache tout les tableau eventuellement ouverts
      console.log('Vous avez cliquez sur  : showDetails');
      var currentRow=$(this).closest("tr");
      var codeMateriel = currentRow.attr('materielId');
      var codeTypeMateriel = currentRow.attr('typeMaterielCode');
      donnees = {
        'codeMateriel' : codeMateriel,
        'codeTypeMateriel' : codeTypeMateriel
      }
      console.log('Show : données à envoyer : '+JSON.stringify(donnees));
      $('#tabZoneShow'+codeTypeMateriel).find('tbody tr').remove();
      $('#tabZoneShow'+codeTypeMateriel).show();
      $('#tabZoneShowAutre').find('tbody tr').remove();
      getDetailsCaracteristiques(donnees);

      if(codeTypeMateriel=='PC' || codeTypeMateriel =='UC' || codeTypeMateriel == 'EC' || codeTypeMateriel =='ES' || codeTypeMateriel =='HDE' || codeTypeMateriel =='CUB'  || codeTypeMateriel =='ON' || codeTypeMateriel =='SW')
      {


        //$('#tabZoneShow'+codeTypeMateriel+' tbody').show();
      //Cachons  les zones eventuellements ouvertes
      objet= [{'code':'UC'},
          {'code':'EC'},
          {'code':'PC'},
          {'code':'HDE'},
          {'code':'SW'},
          {'code':'ON'},
          {'code':'Autre'}
        ];
        cacherZoneTableauSaufCode(objet,'Show',codeTypeMateriel);
      }
      else{
        //$('#tabZoneShowAutre tbody').show();
        objet= [{'code':'UC'},
          {'code':'EC'},
          {'code':'PC'},
          {'code':'HDE'},
          {'code':'ON'},
          {'code':'SW'},
          {'code':'Autre'}
        ];
        cacherZoneTableauSaufCode(objet,'Show','Autre');
    }
  });   
}

//fonction de soumission du formulaire formDetailsMateriel au click du bouton 'ajouterDetailsMateriel'
function soumissionFormulaire()
{
    $("#formDetailsMateriel").on("submit", function(event){
        event.preventDefault();
        var formValues= $(this).serialize();
        var numeroLivraison=$("#codeBordereau").val();
        var donnee = {
            'numeroLivraison' : numeroLivraison,
        }
        
        console.log('données du formulaire : '+formValues);
        //var actionUrl = $(this).attr("ajouterDetailsMateriel");
 
        /*$.post(actionUrl, formValues, function(data){
            // Display the returned data in browser
            //$("#result").html(data);
            $("#modalDetailsMateriel").modal('hide');
            console.log(data);
            //fermeture du modal
        });
        */
       $.ajax({
          type:'POST',
          url:basePath + '/detailsTypeMaterielUcPc/enregistrerDetailsMaterielBordereau',
          data:formValues,
          async:true,
          context : this,
          dataType:'json',
          success:function(resp){
            rechercherMaterielSansClick(donnee);
            console.log('Formulaire envoyée au serveur : '+JSON.stringify(resp));
            if(resp.status == 'SUCCESS')
            {
              //alert( resp.message);
              $("#modalDetailsMateriel").modal('hide');
              $("#formDetailsMateriel")[0].reset();
            }
          },
          error:function (err) {
                console.log('Erreur de l\'envoie du formulaire au serveur : '+JSON.stringify(err));
          }
        }
      );
    });

}

function getDetailsCaracteristiques(donnees)
{
    $.ajax({
      type:'POST',
      url:basePath + '/detailsTypeMaterielUcPc/getDetailsCaracteristiques',
      data:donnees,
      async:true,
      context : this,
      dataType:'json',
        success:function(resp){
          console.log('Formulaire envoyée au serveur : '+JSON.stringify(donnees));
          if(resp.status == 'SUCCESS' && resp.data.length>0)
            {
              console.log('Donnée réçu  à la taille zéro : '+JSON.stringify(resp));
              resp.data.forEach(element => {
                appendToShowTable(element,donnees.codeTypeMateriel);
              });
              //alert( resp.message);
              $("#modalShowDetailsMateriel").modal('show');
              //$("#formDetailsMateriel")[0].reset();
            }
            
        },
        error:function (err) {
          console.log('Erreur de l\'envoie du formulaire au serveur : '+JSON.stringify(err));
        }
        }
      );
}


function appendToShowTable(element,code)
{
  
  console.log('Dans appendToShowTable '+code);
  var laLigne = '<tr class="text-secondary text-center" typeMaterielCode="'+
          element.typeMaterielCode+'" numBordereau="'+
          element.codeBordereau+'" materielId="'+
          element.id+'"> <td>'+element.numeroSerie+'</td> <td>'+
          element.marque +'</td><td> '+element.modele+' </td>';
  if(code!='PC' && code !='UC' && code !='EC' && code !='ES' &&  code !='HDE' &&  code !='CUB' &&  code !='ON' &&  code !='SW')
  {
    console.log('Dans appendToShowTable,append AUTRE'+code);
    laLigne = laLigne+'<tr>';
    
    $('#tabZoneShowAutre tbody').append(laLigne);
  }
  else{
      if(code =='PC')
      {
        console.log('Dans appendToShowTable,append '+code);
        laLigne = laLigne+'<td>'+
        element.ram+'</td> <td>'+element.rom+' Go </td><td>'+
        element.frequence+' Go </td> <td>'+element.ecran+' \'\'</td><tr>';
        
        $('#tabZoneShowPC tbody').append(laLigne);
        //return laLigne;
      }
      if(code =='UC')
      {
        console.log('Dans appendToShowTable,append '+code);
        laLigne = laLigne+'<td>'+
        element.ram+' Go </td> <td>'+element.rom+' Go </td><td>'+
        element.frequence+'</td><tr>';
        
        $('#tabZoneShowUC tbody').append(laLigne);
        //return laLigne;
      }
      if(code =='EC' || code=='ES')
      {
        console.log('Dans appendToShowTable,append '+code);
        laLigne = laLigne+'<td>'+element.ecran+' \'\'</td><tr>';
        
        $('#tabZoneShowEC tbody').append(laLigne);
        return laLigne;
      }
      if(code =='HDE' || code =='CUB' )
      {
        console.log('Dans appendToShowTable,append '+code);
        laLigne = laLigne+'<td>'+element.rom+' Go </td><tr>';
        $('#tabZoneShowHDE tbody').append(laLigne);
        
        $('#tabZoneShowHDE tbody').append(laLigne);
        //return laLigne;
      }
      if(code =='SW')
      {
        console.log('Dans appendToShowTable,append  '+code);
        laLigne = laLigne+'<td>'+element.nbrPort+'</td><tr>';
        //return laLigne;
        
        $('#tabZoneShowSW tbody').append(laLigne);
      }
      if(code =='ON')
      {
        console.log('Dans appendToShowTable,append  '+code);
        laLigne = laLigne+'<td>'+element.puissance+'</td><tr>';
        //return laLigne;
        
        $('#tabZoneShowON tbody').append(laLigne);
      }
  
    }    
        
}


