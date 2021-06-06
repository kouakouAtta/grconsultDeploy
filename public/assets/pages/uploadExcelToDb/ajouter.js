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
    
    $(".dropify").dropify({
    messages:{
        default:"Faites glisser ou cliquer pour ajouter une image",
            replace:"Faites glisser ou cliquer pour modifier cette image",
            remove:"Supprimer",
            error:"Ooops, une erreur a été rencontrée."
        },
        error:{
            fileSize:"La taille du fichier est trop grande (1M max)."
        }
    });


});

i = 1;


$(document).ready(function(e){
    //e.preventDefault();
    $('[data-toggle="select2"]').select2();
    addElementToTable();
    DelElementFromTable();
    addElementToBd();
});

function DelElementFromTable()
{
    // code to read selected table row cell data (values).
    $("#materiel-bordereau-datatable").on('click','#delete',function(){
        // get the current row
        var currentRow=$(this).closest("tr"); 
        currentRow.remove();
        return false;
        //var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
        //var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
        //var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
        //var data=col1+"\n"+col2+"\n"+col3;
        //alert(data);
    });
        
}

function addElementToTable()
{
    $("#ajouterMateriel").on('click',function(){
        //recuperation des informations saisies
        //recupération des propriétés text des valeurs saisies et selectionnées
        var valTextTml=$("#typeMateriel option:selected").text();
        var valTextmqer=$("#marque option:selected").text();
        var valTextmdl=$("#modele option:selected").text();
        var valTextQte=$("#quantite").val();
        if (valTextQte=='')
        {
            //alert('Vueillez indiquer la la quantité s\' il vous plaît')
            Swal.fire('Vueillez indiquer la quantité s\' il vous plaît');
        }
        else{
            
            var valTml=$("#typeMateriel").val();
            var valMqr=$("#marque").val();
            var valMdl=$("#modele").val();
            var valQte=$("#quantite").val();

            var arrData=[{   "type" : valTml+' - '+ valTextTml,
                            'marque' : valMqr +' - '+ valTextmqer,
                            'modele' : valMdl +' - '+ valTextmdl,
                            'quantite' : valQte +' - '+ valTextQte
                        }];
            //alert(JSON.stringify(arrData));
            //Ajout et affichage dans le tableau
            var ligneTab = "<tr>"
            +"<td><input hidden='true' style='text-align: center;' name='type[]' type='text' value='"+valTml+"'>"
            +valTextTml+"</td width='10%'>"+"<td><input hidden='true' name='marque[]' style='text-align: center;' type='text' value='"+valMqr+"'>"
            +valTextmqer+"</td width='10%'>"+"<td><input hidden='true' name='modele[]' style='text-align: center;' type='text' value='"+valMdl+"'>"
            +valTextmdl+"</td width='10%'>"+"<td style='text-align: center;'><input hidden='true' name='quantite[]' style='text-align: center;' type='text' value='"+valQte+"'>"
            +valTextQte+"</td width='10%'>"+"<td style='text-align: center;'>"+"<a href='' id='delete' class='btn btn-outline-danger'><i class='feather-trash-2'></i></a>"
            +"</td>"
            +"</tr>";
            //alert(ligneTab);
            $('#materiel-bordereau-datatable tbody').append(ligneTab);
            //On vide la zone de la quantité
            $("#quantite").val("");

        }
        //recupereration des values des valeurs saisies et selectionnées
        
     
     });

}



function addElementToBd()
{
    var arrData={};
    var objBon = {};
    var objMateriel = [];
    $("#enregistrer1").on('click',function(){
        
        //recupereration des values des valeurs saisies et selectionnées
        var numeroLivraison=$("#numeroLivraison").val();
        var dateReception=$("#dateReception").val();
        var fournisseurId=$("#fournisseurId").val();
        var nomLivreur=$("#nomLivreur").val();
        var telLivreur=$("#telLivreur").val();
        var observation=$("#observation").val();

        objBon = {  'numeroLivraison' : numeroLivraison,
                    'dateReception' :   dateReception,
                    'fournisseurId' :   fournisseurId,
                    'nomLivreur' :      nomLivreur,
                    'telLivreur' :      telLivreur,
                    'observation' :     observation
                };
        //arrData.push(obj);
        //alert(JSON.stringify(objBon));
        
        // On parcours chaque ligne (tr) pour recupérer la valeur de chaque input caché se trouvant dans le td
        $("#materiel-bordereau-datatable tr").each(function(){
             var currentRow=$(this);
             var type=currentRow.find("td:eq(0) input").val();
             var marque=currentRow.find("td:eq(1) input").val();
             var modele=currentRow.find("td:eq(2) input").val();
             var qte=currentRow.find("td:eq(3) input").val();
             var obj = {   'type' : type,
                            'marque' : marque,
                            'modele' : modele,
                            'quantite' : qte
                        }
             objMateriel.push(obj);
        });

        arrData = {
                    'bordereau' : objBon,
                    'materiels' : objMateriel
                };

        
         //alert(JSON.stringify(arrData));
         console.log(JSON.stringify(arrData));
         //Ajout dans la bd en appelant la route saveData du controller BordereauController
         //alert('vous avez cliquez sur enregistrer');
         $.ajax({
            type:'POST',
            url:basePath + '/ajax/saveData',
            data:arrData,
            async:true,
            dataType:'json',
            success:function(resp){
              //const commandesByDay1 = resp;
              alert('vous avez cliquez sur enregistrer : cas de succès : '+JSON.stringify(resp));
              console.log('SUCCES de ajout de bordereau et materiels : '+resp);
            },
            error:function (err) {
                alert('vous avez cliquez sur enregistrer : cas d\'erreur : '+JSON.stringify(err));
                  console.log('ERREUR de ajout de bordereau et materiels : '+err);
            }
          }
        );
     
     });

}