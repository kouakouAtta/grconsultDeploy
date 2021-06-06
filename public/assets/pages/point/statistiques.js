/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
$(document).ready(function() {
    statisticsCharts();
});

function statisticsCharts(){
    
    $.ajax({
        method: "POST",
        url: basePath + '/ajax/les-activites-de-mes-agents',
        "data": {
                  start : $('#start').val(), 
                  end : $('#end').val(), 
                  agent : $('#end').val(), 
                  executionState : $('#executionState').val(),
                  typeActivite : $('#typeActivite').val()
              }
    })
    .done(function( infos ) {
        
        var nbrActivityByProject = infos.projectCount;
        var nbrAgentByProject = infos.agentProjet;
        var nbrActivityByAgent = infos.agentCount;
        
        CanvasJS.addCultureInfo("fr", 
        {      
          decimalSeparator: ",",// Observe ToolTip Number Format
          digitGroupSeparator: ".", // Observe axisY labels  
          savePNGText: "PNG",
          saveJPGText: "JPG",
          menuText: "Plus d'options",
          printText: "PDF"

        });
        CanvasJS.addColorSet("doubleBar",
            [//colorSet Array

            "#f66300",
            "#009177"                
        ]);
        CanvasJS.addColorSet("greenShades",
            [//colorSet Array

            "#f66300",
            "#008080",
            "#2E8B57",
            "#3CB371",
            "#90EE90"                
        ]);

        
        var chart1 = new CanvasJS.Chart("chart1", {
            animationEnabled: true,
            exportEnabled: true,
            culture:"fr",
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            colorSet: "doubleBar",
            title:{
                text: "Nombre d'activités et d'agents par projet"
            },
            data: [
                {
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "white",
                    name: "Nombre d'activités par projet",
                    showInLegend: true,
                    indexLabelPlacement: "inside",   
                    dataPoints: nbrActivityByProject
                },
                {
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "white",
                    name: "Nombre d'agents par projet",
                    showInLegend: true,
                    indexLabelPlacement: "inside",   
                    dataPoints: nbrAgentByProject
                }
            ]
        });
        
        var chart2 = new CanvasJS.Chart("chart2", {
            animationEnabled: true,
            exportEnabled: true,
            culture:"fr",
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            colorSet: "greenShades",
            title:{
                    text: "Nombre d'activités par agent"
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "white",
                    indexLabelPlacement: "inside",   
                    dataPoints: nbrActivityByAgent
            }]
        });
        
        chart1.render();
        chart2.render();
        
    })
    ;
    
}

function collabModal(activite){
    $('#modal-collaborateurs').modal();
    $('#bodyModalCollab').html( $('#loadingAnimation').html() );
    
    $.ajax({
        method: "POST",
        url: basePath + '/ajax/collaborateurs-sur-point',
        data: 'id=' + activite
    })
    .done(function( collaborateurs ) {
        //alert(collaborateurs);
       
        var html = '<input type="hidden" name="activiteId" value="'+activite+'" />';
        var listeCollab = collaborateurs.listeCollab;
        for(var i=0;i<listeCollab.length;i++){
            checked = listeCollab[i].collabId == null ? '' : 'checked="checked"';
            if(collaborateurs.propietaireId==listeCollab[i].userId){
                html += '<div class="row"> \n\
                            <div class="col-sm-2"></div> \n\
                            <div class="col-sm-8" style="border:1px #EEE solid; margin-top:5px"> \n\
                                <h4> <input checked="checked" disabled="disabled" type="checkbox" name="collab'+i+'" id="collab'+i+'" value="'+listeCollab[i].userId+'" />&nbsp;&nbsp; <i class="fa fa-user-secret"></i> <label for="collab'+i+'" style="font-size:16px">'+listeCollab[i].fullName+'</label></h4> \n\
                            </div> \n\
                            <div class="col-sm-2"> </div> \n\
                        </div>';
            }else{
                html += '<div class="row"> \n\
                            <div class="col-sm-2"></div> <input type="hidden" name="_collab'+i+'" value="'+listeCollab[i].collabId+'" /> \n\
                            <div class="col-sm-8" style="border:1px #EEE solid; margin-top:5px"> \n\
                                <h4> <input '+checked+' type="checkbox" name="collab'+i+'" id="collab'+i+'" value="'+listeCollab[i].userId+'" />&nbsp;&nbsp; <i class="fa fa-user"></i> <label for="collab'+i+'" style="font-size:16px">'+listeCollab[i].fullName+'</label></h4> \n\
                            </div> \n\
                            <div class="col-sm-2"> </div> \n\
                        </div>';
            }
        }
        
        //setTimeout(function(){
            $('#activity').html(collaborateurs.activity);
            $('#bodyModalCollab').html(html);
        //}, 500)
        
    })
    /*.error(function(jqXHR, textStatus, errorThrown ){
              alert(textStatus+' : '+errorThrown);  
    })*/
    ;
    
}

function close(modalId){
    $('#'+modalId).modal('hide');
}

function deleteAction(id){
    $('#confirmer-suppression').modal('show');
    $("#confirmer-btn-mandat").attr('href', basePath + '/pointactivites/delete/'+id);
}

function formatDateMysql(elem) {
    if (!elem) return '-';
    //$part = $elem.split(' ');
    $part_date = elem.split('-');
    return $part_date[2]+'/'+$part_date[1]+'/'+$part_date[0];
}

function getActiviteFlag(type){
    if(type==='3'){
        return "<span class='label label-success myBadge2'>GestSup</span> : ";
        
    }else if(type==='2'){
        return "<span class='label label-danger myBadge2'>Tâche</span> : ";
        
    }else{
        return '';
    }
}
