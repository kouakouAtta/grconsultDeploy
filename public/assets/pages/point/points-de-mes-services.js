/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $(".tableau").DataTable(
    {
        oLanguage: {sUrl: basePath + '/plugins/datatables/jquery.dataTables.fr.json'},
    });
    
    $('#exportExcel').on('click',function(){
        $('#frmExportExcel').submit();
        return false;
    });
    
    $('#validatePoints').on('click',function(){
        $('#frmValidatePoints').submit();
        return false;
    });
    
    $('#exportWord').on('click',function(){
        $('#frmExportWord').submit();
        return false;
    });
    
});

function showCollabModal(activite, content){
    $('#modal-collaborateurs').modal();
    var html = '<div class="row"> <div class="col-sm-12"> <b>Activité</b> :  '+activite +' </div> </div><br/>';
        html += $('#'+content).html();
    $('#bodyModalCollab').html(html);
}
