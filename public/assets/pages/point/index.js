/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
$(document).ready(function() {
    
    
    $('#tableau').DataTable({
        //
        sDom : "<'top row'<'col-sm-2'l><'col-sm-7 ctnCmd'><'col-sm-3'f> >rt<'bottom'ip<'clear'>>",
        bLengthChange: true,
        iDisplayLength: 10,
        sAjaxSource: basePath + '/ajax/mes-activites',
        sServerMethod: 'post',
        fnServerData: function ( sSource, aoData, fnCallback, oSettings ) {
            oSettings.jqXHR = $.ajax( {
              "dataType": 'json',
              "type": "POST",
              "url": sSource,
              "data": {
                  start : $('#start').val(), 
                  end : $('#end').val(), 
                  executionState : $('#executionState').val(),
                  typeActivite : $('#typeActivite').val()
              },
              "success": fnCallback
        } )},
        aaSorting: [[6, 'desc']],
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
        fnRowCallback: function(nRow, aData, iDisplayIndex){
            //alert(aData['id']);
            //$('td:eq(0)', nRow).html(getActiviteFlag(aData[10])+ (aData[0]==null||aData[0]=='null'?aData[11]:aData[0]) );
            $('td:eq(0)', nRow).html(getActiviteFlag(aData[10])+ aData[0]);
            $('td:eq(1)', nRow).html('<span id="activite'+aData[6]+'">'+aData[1]+'</span>');
            $('td:eq(2)', nRow).html(aData[7]=='0000-00-00'?'-': formatDateMysql(aData[7]) );
            $('td:eq(3)', nRow).html(formatDateMysql(aData[2]));
            $('td:eq(4)', nRow).html(aData[3]=='0000-00-00'?'-': formatDateMysql(aData[3]) );
            $('td:eq(5)', nRow).html(getStatutFag(aData[4], aData[8]));
            //$('td:eq(6)', nRow).html(alignCenter(aData[8]+'%'));
            $('td:eq(6)', nRow).html(aData[5]);
            $('td:eq(7)', nRow).html(getBtn(aData));
            
        },
        drawCallback: function( aData ) {
            $('.ctnCmd').html(
                    '<a href="'+basePath+'/pointactivites/add" class="btn btn-outline-primary mt-0 btn-rounded waves-effect waves-light" style="border:1px; margin:3px 10px;">'+
                    '    <i class="fa fa-plus"></i>'+
                    '    &nbsp;&nbsp;&nbsp;<b>Ajouter une activité</b>&nbsp;&nbsp;&nbsp;'+
                    '</a>'+
                    '<a id="exportExcel2" href="#" class="btn btn-outline-success mt-0 btn-rounded waves-effect waves-light" style="border:1px; margin:3px 10px;">'+
                    '    <i class="fa fa-download"></i>'+
                    '    &nbsp;&nbsp;&nbsp;<b>Excel</b>&nbsp;&nbsp;&nbsp;'+
                    '</a>'+
                    (hideBtnCloseWeek==='yes' ? '' : '<a id="btnCloture" href="#" class="btn btn-outline-danger mt-0 btn-rounded waves-effect waves-light" style="border:1px; margin:3px 10px;">'+
                    '    <i class="fa fa-check"></i>'+
                    '    &nbsp;&nbsp;&nbsp;<b>Clôturer les activités</b>&nbsp;&nbsp;&nbsp;'+
                    '</a>')
            );
            $('#exportExcel2').on('click',function(){
                var savAction = $("#frmFiltre").attr('action');
                $("#frmFiltre").attr('action', basePath+'/ajax/export-excel');
                $("#frmFiltre").attr('target','_blank');
                $("#frmFiltre").submit();
                
                $("#frmFiltre").attr('action', savAction);
                $("#frmFiltre").removeAttr('target');
                return false;
            });
            $('#btnCloture').on('click',function(){
                swal({
                    title:"Confirmation",
                    text:"Vous êtes sur le point de clôturer vos activités de la semaine. Vous ne pourriez plus effectuer de modification pour cette semaine.\n\n Voulez-vous vraiement clôturer vos activités ?",
                    type:"warning",
                    cancelButtonText:"Annuler",
                    showCancelButton:!0,
                    confirmButtonText:"Oui, clôturer",
                    confirmButtonColor:"#f29d56",
                    closeOnConfirm:!1
                },
                    function(){$('#frmClotureActivite').submit();}
                );
                //$('#frmClotureActivite').submit();
                return false;
            });
        }
    });
    
    /*$("#exportExcel").attr('href', basePath + "/ajax/exportExcel");
    
    start = escape($('#start').val());
    end = escape($('#end').val());
    if(start != ""){
        $("#exportExcel").attr('href', basePath + "/ajax/exportExcel/" + start);
        if(end != ""){
            $("#exportExcel").attr('href', basePath + "/ajax/exportExcel/" + start + "/" + end);
        }
    }*/
    $('#exportExcel').on('click',function(){
        $("#frmExportExcel").submit();
        return false;
    });
    
    /*
    setTimeout(function(){
        alert( 'Left='+$('#exportExcel2').offset().left+ ', Top='+ $('#exportExcel2').offset().top  );
    }, 2000);
    */
    
    /* var tour = {
        autoStart: true,
        useOverlay: true,
        data : [
            { element : '#btnCloture', tooltip : "<h3>NOUVELLE FONCTIONALITE</h3> <p>Vous devez maintenant cloturer vos activités en fin de semaine. Cela permet une meiheur visibilité <br/>à votre supérieur hiérachique.</p>", text: 'With an standard lorem ipsum', position: 'T' },
            { element : '#exportExcel2', tooltip : 'This is the\n second panel', text: 'Same as panel 1', position: 'T' },
            
        ],
        stepText: '1 of 3',
        message: 'page 1 content',
        //welcomeMessage: 'Welcome to the Demo #1',
        controlsPosition : 'TR',
        buttons: {
            next  : { text : 'Next &rarr;', class : 'btn btn-default'},
            prev  : { text : '&larr; Previous', class: 'btn btn-default' },
            start : { text : 'Start', class: 'btn btn-primary' },
            end   : { text : 'End', class: 'btn btn-primary' }
        },
        controlsCss: {
            background: 'rgba(124, 124, 124, 0.8)',
            color: '#fff',
            width: '400px',
            //display : 'none',
            //'border-radius': 0
        }
    };
    $.aSimpleTour(tour); */
    
});

function escape(data)
{
    return data.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "");
}

function getStatutFag(statut, prt){
    if(statut=='Terminé'){
        return '<span class="badge badge-pill badge-success float-right" style="font-size:inherit;font-weight:inherit">'+statut+'</span>';
        
    }else if(statut=='En cours'){
        return '<span class="badge badge-pill badge-warning float-right" style="font-size:inherit;font-weight:inherit">'+statut+'</span>&nbsp; '+prt+'%';
        
    }else{
        return '<span class="badge badge-pill badge-primary float-right" style="font-size:inherit;font-weight:inherit">'+statut+'</span>';
    }
}
    
function getBtn(aData){
    
    var btnDelete = 
            "        <a href='"+basePath+"/pointactivites/modifier/"+aData[6]+"' data-toggle='tooltip' data-placement='top' title='Modifier' " +
            "            class='btn btn-outline-info btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-edit'></i> " +
            "        </a> ";
    
    btnDelete += 
            "        <a id='btn"+aData[6]+"' href='javascript:collabModal("+aData[6]+")' data-toggle='tooltip' data-placement='top' title='collaborateurs sur cette activité' " +
            "            class='btn btn-outline-success btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-users'></i> " + (aData[12]>0? "<span class='badge badge-pill badge-danger float-right'>"+aData[12]+"</span> " : '') +
            "        </a> ";
    
    if(aData[12] == 0 && aData[9] == null){
         btnDelete += 
            "        <a href='javascript:deleteAction("+aData[6]+")' data-toggle='tooltip' data-placement='top' title='Supprimer' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-trash'></i> " +
            "        </a> ";
    }
    
    if(aData[9] != null && aData[4]!='Terminé'){
        btnDelete += 
            "        <a id='btnAnswer"+aData[9]+"' href='javascript:answerModal("+aData[9]+")' data-toggle='tooltip' data-placement='top' title='Repondre au ticket' " +
            "            class='btn btn-outline-danger btn-rounded waves-effect waves-light'> " +
            "             <i class='feather-message-circle'></i> " +
            "        </a> ";
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
                            <div class="panel panel-success myPanel">\n\
                                <div class="panel-heading" id="accordion">\n\
                                    <span class="fa fa-comments"></span> Discussion\n\
                                    <div class="btn-group pull-right">\n\
                                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">\n\
                                            <span class="fa fa-chevron-down"></span>\n\
                                        </a>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="panel-collapse collapse in" id="collapseOne">\n\
                                    <div class="panel-body">\n\
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
                </div>';
        
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
                                <h4> <input '+checked+' type="checkbox" name="collab'+i+'" id="collab'+i+'" value="'+listeCollab[i].userId+'" />&nbsp;&nbsp; <i class="feather-user"></i> <label for="collab'+i+'" style="font-size:16px">'+listeCollab[i].fullName+'</label></h4> \n\
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
    $("#confirmer-btn-mandat").attr('href', basePath + '/pointactivites/modifier/'+id);
}

function formatDateMysql(elem) {
    if (!elem) return '-';
    //$part = $elem.split(' ');
    $part_date = elem.split('-');
    return $part_date[2]+'/'+$part_date[1]+'/'+$part_date[0];
}

function getActiviteFlag(type){
    if(type==='3'){
        return "<span class='badge badge-pill badge-success float-right myBadge2'>GestSup</span> : ";
        
    }else if(type==='2'){
        return "<span class='badge badge-pill badge-danger float-right myBadge2'>Tâche</span> : ";
        
    }else{
        return '';
    }
}
