/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
$(document).ready(function() {
    $('#tableau').DataTable({
        sDom : "<'top row'<'col-sm-2'><'col-sm-7 ctnCmd'><'col-sm-3'f> >rt<'row'<'col-sm-5'i><'col-sm-7 mydt'p><'clear'>>",
        //bLengthChange: true,
        iDisplayLength: 10,
        sAjaxSource: basePath + '/ajax/mes-tickets',
        sServerMethod: 'post',
        fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
            oSettings.jqXHR = $.ajax( {
              "dataType": 'json',
              "type": "POST",
              "url": sSource,
              "success": fnCallback
        } )},
        aaSorting: [[0, 'desc']],
        oLanguage: {sUrl: basePath + '/assets/js/jquery.dataTables/jquery.dataTables.fr.json'},
        fnRowCallback: function(nRow, aData, iDisplayIndex){
            //alert(aData['id']);
            $('td:eq(0)', nRow).html(getGestSupLink(aData[0]));
            $('td:eq(1)', nRow).html(aData[1].charAt(0)+'. '+ aData[3]);
            $('td:eq(2)', nRow).html(aData[6]);
            $('td:eq(3)', nRow).html(aData[7]);
            $('td:eq(4)', nRow).html(aData[8]);
            $('td:eq(5)', nRow).html(aData[9]);
            $('td:eq(6)', nRow).html(formatDateMysql(aData[10].slice(0, -9)));
            $('td:eq(7)', nRow).html(getStatutFag(aData[11]));
            $('td:eq(8)', nRow).html(getBtn(aData));
            
        }
    });
    
    
});


function escape(data)
{
    return data.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "");
}

function getStatutFag(statut){
    if(statut==='Terminé'){
        return '<span class="label label-success" style="font-size:inherit;font-weight:inherit">'+statut+'</span>';
        
    }else if(statut==='En cours'){
        return '<span class="label label-warning" style="font-size:inherit;font-weight:inherit">'+statut+'</span>';
        
    }else if(statut==='Attente PEC'){
        return '<span class="label label-primary" style="font-size:inherit;font-weight:inherit">'+statut+'</span>';
        
    }else{
        return '<span class="label label-default" style="font-size:inherit;font-weight:inherit">'+statut+'</span>';
    }
}
    
function getBtn(aData){
    
    var btnDelete = "<nobr>" +
            "        <a data-hint='Repondre au ticket' id='btnAnswer"+aData[0]+"' data-placement='top'" +
            "            href='javascript:answerModal("+aData[0]+")' class='btn btn-xs menu-icon vd_bd-red vd_red hint--top'> " +
            "             <i class='fa fa-commenting fa-2x'></i> " +
            "        </a>";
    
    if(aData[11] == 'En cours'){
        btnDelete += 
            "        <a data-hint='collaborateurs sur le ticket' id='btn"+aData[0]+"' data-placement='top'" +
            "            href='javascript:collabModal("+aData[0]+",1"+")' class='btn btn-xs menu-icon vd_bd-red vd_red hint--top'> " +
            "             <i class='fa fa-users fa-2x'></i> " + (aData[12]>0? "<span class='label label-danger myBadge'>"+aData[12]+"</span> " : '') +
            "        </a>";
    }
    else{
        btnDelete += 
            "        <a data-hint='Prendre en charge le ticket' id='btn"+aData[0]+"' data-placement='top'" +
            "            href='javascript:collabModal("+aData[0]+",2"+")' class='btn btn-xs menu-icon vd_bd-red vd_red hint--top'> " +
            "            &nbsp;<i class='fa fa-arrow-circle-right fa-2x'></i> " +
            "        </a> </nobr>";
    }
    
    
    return btnDelete;
}

function answerModal(activite){
    $('#modal-answer').modal();
    $('#bodyModalAnswer').html( $('#loadingAnimation').html() );
    
    $.ajax({
        method: "POST",
        url: basePath + '/ajax/get-ticket',
        data: "id="+activite
    })
    .done(function( infos ) {
        
        var threads = infos.threads;
        var html = '<input type="hidden" name="domaine" value="'+infos.domaine+'" />';
        html += '<input type="hidden" name="activity" value="'+infos.activity+'" />';
        html += '<input type="hidden" name="expiryDate" value="'+infos.expiryDate+'" />';
        html += '<input type="hidden" name="startDate" value="'+infos.startDate+'" />';
        html += '<input type="hidden" name="endDate" value="'+infos.endDate+'" />';
        html += '<input type="hidden" name="executionState" value="'+infos.executionState+'" />';
        html += '<input type="hidden" name="ticketNum" value="'+infos.ticketNumber+'" />';
        html += '<input type="hidden" name="technician" value="'+infos.technician+'" />';
        html +='<div class="container" style="margin-top:10px; width:1330px;">\n\
                    <div class="row">\n\
                        <div class="col-md-5">\n\
                            <div class="panel panel-success myPanel" id="panelDisc">\n\
                                <div class="panel-heading" id="accordion">\n\
                                    <span class="fa fa-comments"></span> Discussion\n\
                                    <div class="btn-group pull-right">\n\
                                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" id="cmdPanelDisc">\n\
                                            <span class="fa fa-chevron-down"></span>\n\
                                        </a>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="panel-collapse collapse in" id="collapseOne">\n\
                                    <div class="panel-body" id="panel-body">\n\
                                        <ul class="chat">';
        
        html +='<li class="left clearfix"><span class="chat-img pull-left">\n\
                                <img src="http://placehold.it/50/009177/fff&text='+infos.requesterFirstName.charAt(0).toUpperCase()+infos.requesterLastName.charAt(0).toUpperCase()+'" alt="User Avatar" class="img-circle" />\n\
                                </span>\n\
                                <div class="chat-body clearfix">\n\
                                    <div class="header">\n\
                                        <strong class="primary-font">'+infos.requesterFirstName+" "+infos.requesterLastName+'</strong> <small class="pull-right text-muted">\n\
                                            <span class="fa fa-clock-o"></span> '+infos.createDate+'</small>\n\
                                    </div>\n\
                                    <p>'+infos.description+'</p>\n\
                                </div>\n\
                            </li>';
        
        for (var i = 0; i < threads.length; i++) {
            if(threads[i].answer!=""){
                if(threads[i].author == infos.technician){
                    html +='<li class="left clearfix"><span class="chat-img pull-left">\n\
                                <img src="http://placehold.it/50/f66300/fff&text='+threads[i].firstName.charAt(0).toUpperCase()+threads[i].lastName.charAt(0).toUpperCase()+'" alt="User Avatar" class="img-circle" />\n\
                                </span>\n\
                                <div class="chat-body clearfix">\n\
                                    <div class="header">\n\
                                        <strong class="primary-font">'+threads[i].firstName+" "+threads[i].lastName+'</strong> <small class="pull-right text-muted">\n\
                                            <span class="fa fa-clock-o"></span> '+threads[i].date+'</small>\n\
                                    </div>\n\
                                    <p>'+threads[i].answer+'</p>\n\
                                </div>\n\
                            </li>';
                }
                else{
                    html +='<li class="left clearfix"><span class="chat-img pull-left">\n\
                                <img src="http://placehold.it/50/009177/fff&text='+threads[i].firstName.charAt(0).toUpperCase()+threads[i].lastName.charAt(0).toUpperCase()+'" alt="User Avatar" class="img-circle" />\n\
                                </span>\n\
                                <div class="chat-body clearfix">\n\
                                    <div class="header">\n\
                                        <strong class="primary-font">'+threads[i].firstName+" "+threads[i].lastName+'</strong> <small class="pull-right text-muted">\n\
                                            <span class="fa fa-clock-o"></span> '+threads[i].date+'</small>\n\
                                    </div>\n\
                                    <p>'+threads[i].answer+'</p>\n\
                                </div>\n\
                            </li>';
                }
            }
            
        }
        
        html +='</ul>\n\
                </div>\n\
                </div>\n\
                </div>\n\
                </div>\n\
                </div>\n\
                </div>'
        
        html += '<div class="row"> <div class="col-sm-12" style="margin-top:5px;">Reponse *</div> </div>';
        html += '<div class="row"> \n\
                    <div class="col-sm-12"><textarea id="answer" required = required class="form-control" rows = "4" name="observation"></textarea></div>  \n\
                </div>';
         html += '<div class="row" id="empty" style = "display:none;"> \n\
                    <div class="col-sm-2"></div>\n\
                        <div class="col-sm-8 errors" style="margin-top:5px;">Veuillez entrer votre reponse</div>  \n\
                        <div class="col-sm-2"></div>\n\
                    </div>';
        //setTimeout(function(){
            $('#bodyModalAnswer').html(html);
            $('#tick').html(infos.activity);
            $('#answer').summernote({
                height: 100   //set editable area's height
            });
            $('#confirmer-btn-answer').on('click', function(){
                if($('#answer').val().trim() != ""){
                   $("#formAnswer").submit();
                    return false;
                }
                else{
                    $("#empty").show();
                }
            });
        //}, 200)
        
    })
    ;
    
}

function collabModal(activite, source){
    $('#modal-collaborateurs').modal();
    $('#bodyModalCollab').html( $('#loadingAnimation').html() );
    
    $.ajax({
        method: "POST",
        url: basePath + '/ajax/collaborateurs-sur-point',
        "data": {id:activite, source:source}
    })
    .done(function( collaborateurs ) {
       
        var html = '<input type="hidden" name="activiteId" value="'+collaborateurs.pointId+'" />';
        html += '<input type="hidden" name="isTicket" value="'+collaborateurs.isTicket+'" />';
        html += '<input type="hidden" name="ownerId" value="'+collaborateurs.propietaireId+'" />';
        html += '<input type="hidden" name="activity" value="'+collaborateurs.activity+'" />';
        if(collaborateurs.isTicket){
            html += '<input type="hidden" name="ticketNumber" value="'+collaborateurs.ticketNumber+'" />';
            html += '<input type="hidden" name="domaine" value="'+collaborateurs.domaine+'" />';
        }
        
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
        /*var other = '<div id="notAttrib" class="row" style="display:none;"> \n\
                    <div class="col-sm-1"></div>\n\
                    <div class="col-sm-10 errors" id="notAttribMsg">Veuillez Attribuer le ticket à au moins un collaborateur</div>  \n\
                    <div class="col-sm-1"></div>\n\
                </div>';*/
        var other = '';
        other += '<div class="row"> <div class="col-sm-12">Date d\'échéance *</div> </div>';
        other += '<div class="row"> \n\
                    <div class="col-sm-12" ><input required = required value="'+collaborateurs.expiryDate+'" type="date" name="expiryDate" id="expiryDate" style="width:100%" /></div>  \n\
                  </div>';
        
        other += '<div class="row"> <div class="col-sm-10" style="margin-top:5px;">Observation *</div> </div>';
        other += '<div class="row"> \n\
                    <div class="col-sm-12"><textarea required = required class="form-control" rows="4" name="observation" id="observation">'+collaborateurs.observation+' </textarea></div>  \n\
                  </div>';
        //setTimeout(function(){
            $('#ticket').html(collaborateurs.activity);
            $('#bodyModalCollab').html(html);
            $('#otherContent').html(other);
            $('#confirmer-btn-mandat').on('click',function(){
                var attrib = false;
                for(var i=0;i<listeCollab.length;i++){
                    if(collaborateurs.propietaireId==listeCollab[i].userId){
                        
                    }
                    else{
                        if($('#collab'+i).is(":checked")){
                            attrib = true;
                            break;
                        }
                    }
                }
                if(!attrib){
                    $('#notAttribMsg').html("Veuillez choisir au moins un collaborateur");
                    $("#notAttrib").show();
                    
                }else if( $('#expiryDate').val()=='' || $('#observation').val()=='' ){
                    $('#notAttribMsg').html("Veuillez renseigner tous les champs obligatoire.");
                    $("#notAttrib").show();
                }
                else{
                    $("#formCollab").submit();
                    return false;
                }
            });
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

function formatDateMysql(elem) {
    if (!elem) return '-';
    //$part = $elem.split(' ');
    $part_date = elem.split('-');
    return $part_date[2]+'/'+$part_date[1]+'/'+$part_date[0];
}


function getGestSupLink(id){
    return '<a href="http://'+$('#gestSupHost').val()+'/gestsup/index.php?page=ticket&id='+id+'" class="hint--top" target="_blank" data-hint="Ouvrir dans GestSup">#'+id+'</a>';
}
