var allTranslations = null;

// Evite d'avoir des null qui s'affichent dans les tableaux datatable
function formNull ($elem) {    
    if ($elem == null || $elem == 'null') {
        return '';
    } else {
        return $elem;
    }

}

// Fonction qui permet de couper un chaine si elle depasse la taille maximum et d'ajouter des ... 
// Ne coupe pas un mot entier
function cutContenuElement($elem,$length) {
    $str = $elem.html();
    if ($str.length > $length) {
        $str = $str.substr(0,$length);
        $pos = $str.lastIndexOf(" ");
        if ($pos > 0) {
            $elem.html($str.substr(0,$pos)+'...');
        } 
    } 
}

// fonction qui traduit des 0 et 1 en Non et Oui
function formatStatut ($elem) {
    if ($elem == 0) {
        return 'Inactif';
    } else {
        return 'Actif';
    }
}

// fonction qui traduit des 0 et 1 en Non et Oui
function formatBinaire ($elem) {
    if ($elem == 0) {
        return 'Non';
    } else {
        return 'Oui';
    }
}


function formatLettrage ($elem) {
    if ($elem == 0) {
        return 'Non affecté';
    } else if ($elem == 1){
        return 'Affecté';
    } else if ($elem == 3){
        return 'Pré-affecté';
    } else if ($elem == 4){
        return 'Encaissement hors-périmètre';
    }
}


function ajoutDivClasse($elem,$class) {
    return '<div class="'+$class+'">'+$elem+'</div>';
}

function truncate($elem,$size) {
    var shortText = jQuery.trim($elem).substring(0, $size)
    .split(" ").slice(0, -1).join(" ") + "...";
    
    return shortText;
}

// Fonction permettant l'alignement centrer dans les tableaux
function alignCenter($elem, $align) {
    return '<div align="'+'center'+'">'+$elem+'</div>';
}

// Fonction permettant l'alignement à droite avec séparateur dans les tableaux
function alignRight($elem) {
    return '<div align="right">'+$elem+'</div>';
}

// Fonction permettant l'alignement à gauche avec séparateur dans les tableaux
function alignLeft($elem) {
    return '<div align="left">'+$elem+'</div>';
}
function formatNull ($elem,$remplacant) {
    if ($elem == null || $elem == 'null' || !$elem) {
        return $remplacant;
    } else {
        return $elem;
    }
}
// fonction qui remplace une valeur spécifique ($cond) de $elem par une autre ($new) 
function replaceValue($elem,$cond,$new) {
    if ($elem == $cond) {
        return $new;
    } else {
        return $elem;
    }   
}

// format une civilité (!! ici le code dépend des codes affectées aux civilités, doit être bouger au besoin )
function formatCivilite ($elem) {
    if ($elem == 0) {
        return 'Mr';
    } else {
        if ($elem == 1) {
            return 'Mme';
        }    else {
            return 'Mlle';
        }
    }
}


// fonction d'affichage des détails des emails en partant d'un attribut href
function getModalHref(obj) {
    
    displayUrl = obj.attr('href');
    
    $.post(
        displayUrl
    ).done(function(content){
        $(".modal-body").html(content);
        $('.modal').modal('show');
    });
    
    return false;
}


function formatInd(ind) {
    return '<span style="color:#428bca">'+ind+'</span>';
}

function getLanguageUrl() {
    if ($('#locale_layout').val() == 'en') {
        $languageUrl = oConstantes.baseUrl + "/js/jquery.dataTables/jquery.dataTables.en.json";
    } else {
        $languageUrl = oConstantes.baseUrl + "/js/jquery.dataTables/jquery.dataTables.fr.json"; 
    }
    
    return  $languageUrl;
}

$languageUrl = getLanguageUrl();

// format une date mysql au format français sans les heures/minutes/secondes
function formatDateMysql ($elem) {
    if (!$elem) return '-';
    $part = $elem.split(' ');
    $part_date = $part[0].split('-');
    return $part_date[2]+'/'+$part_date[1]+'/'+$part_date[0];
}

// format une date mysql au format français avec les heures/minutes/secondes
function formatTimeMysql ($elem) {
    if (!$elem) return '';
    $part = $elem.split(' ');
    return $part[1];
}

// format une date mysql au format français avec les heures/minutes/secondes
function formatDateTimeMysql ($elem) {
    if (!$elem) return '';
    $part = $elem.split(' ');
    $part_date = $part[0].split('-');
    return $part_date[2]+'/'+$part_date[1]+'/'+$part_date[0]+' à '+$part[1];
}

// format une date mysql au format français avec les heures/minutes
function formatDateTimeMysqlNoSecond ($elem) {
    if (!$elem) return '';
    $part = $elem.split(' ');
    $part_date = $part[0].split('-');
    $horaires = $part[1].split(':');
    return $part_date[2]+'/'+$part_date[1]+'/'+$part_date[0]+' '+$horaires[0]+':'+$horaires[1];
}

// Fonction permettant l'alignement centrer dans les tableaux
function alignCenter($elem, $align) {
    return '<div align="'+'center'+'">'+$elem+'</div>';
}

// Fonction permettant d'afficher des séparateurs des milliers dans les tableaux
function formatDevise(num, thousands, decimal, symbolBefore, symbolAfter,symbolIfNull) {
    // definition d'un param par default
    if (num == 0) {
        return 0;
    }    
    symbolIfNull = (typeof symbolIfNull !== 'undefined') ? symbolIfNull : '0';
    // affichage si la valeur est nulle et non zero
    if (num == null) {
        return symbolIfNull
    }
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num)) {
        num = symbolIfNull;
    }
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10) {
        cents = "0" + cents;
    }
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++) {
        num = num.substring(0, num.length - (4 * i + 3)) + thousands + num.substring(num.length - (4 * i + 3));
    }
    return ((sign) ? '' : '-') + symbolBefore + num /*+ decimal + cents*/ + symbolAfter;
}

/**
 * Fonction d'affichage d'une popup de confirmation sur le onclick d'un lien
 * @param {type} $message
 * @returns {Boolean}
 */
function confirmLink($message) {
    if (window.confirm($message)) {
        return true;
    } else {
        return false;
    }
}

// soumet un formulaire, utile si on a un bouton button ou un formulaire caché a soumettre
function submitForm($nameForm) {
    $('[name='+$nameForm+']').submit(); 
}

function formatTypePersonne($elem) {
    
    if ($elem === 'P') { 
        return 'Personne physique'; 
    }
    if ($elem === 'M') { 
        return 'Personne Morale';
    } else {
        return '';
    }
    
}

function moveToId($id) {
    $('html, body').animate({
        scrollTop: $($id).offset().top
    }, 500);
}

function getPersonneByType($type,$nom,$prenom,$raisonSocialeTiers,$nccTiers) {
    
     if ($type === 'P') { 
         return $prenom+' '+$nom;
     }
     if ($type === 'M') { 
        return $raisonSocialeTiers+' '+$nccTiers;
    } else {
        return '';
    }
}

var mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre" ];

// $date est au format français
function periodeTaxe($date,$idTaxePeriodicite){
    
    if (!$date) {
        return '';
    }
    
    // pas d'appel ajax mais un doublon avec le helper PHP, a cause de soucis de performance. les historiques contiendront trop d'appels
    $aDate = $date.split('/'); 
    var $oDate = new Date($aDate[1]+'/'+$aDate[0]+'/'+$aDate[2]);

    switch($idTaxePeriodicite) {
        case '1':  // mensuel
        case '3':  // bi-annuel
//        case '7':  // tri-annuel    
            $periode = mois[$oDate.getMonth()]+' '+$oDate.getFullYear();
        break;    
        case '2':  // annuel
            $periode = $oDate.getFullYear();
        break;
        case '5':  //  mensuel/trimestriel en fonction du regime
//            if ($regime == 1) { // réel
                $periode = mois[$oDate.getMonth()]+' '+$oDate.getFullYear();
//            } else {
//                $periode = getTrimestre($oDate.getMonth()+1)+' '+$oDate.getFullYear();
//            }
        break;
        case '6':  //  30 jours apres signature
            //@todo A faire
        break;
        case '4':  // tri-annuel   
             $periode = getTrimestre($oDate.getMonth()+1)+' '+$oDate.getFullYear();
             $periode = 'trimestre '+($oDate.getMonth()+1)+' '+$oDate.getFullYear();
        break;
        case '7':
            $periode = 'tiers '+($oDate.getMonth()+1)+' '+$oDate.getFullYear();
        break;
        case '9':
            $periode = 'fraction '+($oDate.getMonth()+1)+' '+$oDate.getFullYear();
        break;
        case '11':
            $periode = 'période libre';
        break;
        default:
            $periode = 'N.A.';
            //@todo A voir
        break;
    }

    $periode = $periode.toString().charAt(0).toUpperCase() + $periode.toString().substr(1);

    return $periode;
   
}

function getTrimestre($mois) {

    if ($mois <=3 && $mois >0) {
        return 'TRIMESTRE 1';
    }
    if ($mois <=6 && $mois >3) {
        return 'TRIMESTRE 2';
    }
    if ($mois <=9 && $mois >6) {
        return 'TRIMESTRE 3';
    }
    if ($mois <=12 && $mois >9) {
        return 'TRIMESTRE 4';
    }

}

function getBiAnnuel($mois) {

    if ($mois <=6 && $mois >0) {
        return 'MOITIÉ ANNÉE 1';
    }
    if ($mois <=12 && $mois >6) {
        return 'MOITIÉ ANNÉE 1';
    }

}

function getTriAnnuel($mois) {

    if ($mois <=4 && $mois >0) {
        return 'TIERS 1';
    }
    if ($mois <=8 && $mois >4) {
        return 'TIERS 2';
    }
    if ($mois <=12 && $mois >8) {
        return 'TIERS 3';
    }

}

function zeroSiDifferenceNegative(valeur1,valeur2) {

    $valeur1 = myParseFloat(valeur1); //   bien que ormalement sur ce projet on ne devrait avoir que de l'entier
    $valeur2 = myParseFloat(valeur2);

    $soustraction = $valeur1 - $valeur2; 

    if ($soustraction <0 ) {
        return 0;
    } else {
        return $soustraction; 
    }

}

function myParseFloat($elem) {

    if ($elem) {
        $elem = String($elem);
        $number = $elem.replace(/ /g, "");
        return parseFloat($number);
    } else {
        return 0;
    }

}

function myParseInt($elem) {

    if ($elem) {
        $elem = String($elem);
        $number = $elem.replace(/ /g, "");
        return parseInt($number);
    } else {
        return 0;
    }

}

function translate(keyName, strict)
{
    strict = (strict !== undefined && strict === true ? true : false);

    var translation = (strict ? null : keyName);

    if (allTranslations === null)
    {
        $.ajax({
            url: (oConstantes.baseUrl + '/services/traduction/trad-file?file=all'),
            dataType: 'JSON',
            async: false
        }).done(function(data) {
            allTranslations = data;
        });
    }

    $.each(allTranslations, function(file, values) {
        $.each(values, function(key, value) {
            if (key == keyName)
                translation = value;
        });
    });

    return (translation);
}

// a mettre dans le parent
function intersection(arr1, arr2) {
   var results = [];
    for (var i = 0; i < arr1.length; i++) {
        if (arr2.indexOf(arr1[i]) !== -1) {
            results.push(arr1[i]);
        }
    }
    return results;
}

function duplicateEnsembleInputFile() {

        var $DuplicateElement_cpt=0;

    $('.duplicateEnsembleInputFile').click(function(){
        
        var $duplicateEnsemble_cpt = parseInt($("#numeroEnregistrement").val())+1;
        $DuplicateElement_cpt= $DuplicateElement_cpt+1;

        $composant = $(this).parents('.ensembleInputFile');
        
        
        $clone = $composant.clone().css('margin-top','10px').css('margin-bottom','10px');
        $clone.addClass("ensembleElementFacultatif").removeClass('ensembleInputFile');
        $clone.find('.duplicateEnsembleInputFile').remove();
        $clone.find('.title_orange').css('color','#957782').html('Élement supplémentaire similaire');



        $inputFile = $clone.find('.inputFile');

        //renommage de l'input file name
        $inputFile.attr('filename',$inputFile.attr('name')+'_ELEMENT_'+$DuplicateElement_cpt);
        
        //renommage de l'input name fichier
        $inputFile.attr('name',$inputFile.attr('name')+'_ELEMENT_'+$DuplicateElement_cpt);

      
        //vider l'input file
        $inputFile.val("");

        //renommage de l'input du commentaire
        $inputCommentaire = $clone.find('.inputCommentaire');
        $inputCommentaire.attr('name',$inputCommentaire.attr('name')+'_ELEMENT_'+$duplicateEnsemble_cpt);

        //renommage de l'input fichier type document
        $inputDocType = $clone.find('.inputDocType');
        $inputDocType.attr('name',$inputDocType.attr('name')+'_ELEMENT_'+$DuplicateElement_cpt);

        $duplicateEnsemble_cpt++;

        $composant.after($clone);

        return false;    
    });
}

function gestionTaxesDependance(elementName, selector, dependanceLinkName) {

    checkboxes = document.getElementsByName(elementName);

    for(i=0;i<checkboxes.length;i++) {
        if (checkboxes[i].hasAttribute(dependanceLinkName) ){
            $lien= checkboxes[i].getAttribute(dependanceLinkName);
            $id= checkboxes[i].getAttribute(selector);
                biToggle($id,$lien);
          }
    }
}

function biToggle(id1, id2) {
     $("#"+id1).change(function(){
           toggle(this, id2);
    });
     $("#"+id2).change(function(){
           toggle(this, id1);
    });
}

function toggle(source, $id) {
    checkbox = document.getElementById($id);
    checkbox.checked = source.checked;
}

function stringToNumber(str) {
    str = str.replace(/\s/g, '');
    return parseInt(str);
}

// @param : dtId = l'id de la table
function convertToDataTable(dtId) {

    $params = {
        sDom: "<'row '<'col-xs-6'l><'col-xs-6'f>r>" + "t" + "<'row'<'col-xs-12'pi>>",
        bLengthChange: false,
//        iDisplayLength: 10,
        bFilter: true,
        bSort: true,
        bPaginate: true,

       oLanguage: {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher :",
            "sLengthMenu":     "Afficher _MENU_ éléments",
            "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun élément à afficher",
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "oPaginate": {
                "sFirst":      "Premier",
                "sPrevious":   "Précédent",
                "sNext":       "Suivant",
                "sLast":       "Dernier"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        }
    };

    if (typeof oTable == 'undefined') {
        oTable = $('#'+dtId).dataTable($params);
    } else {
        oTable.fnClearTable(0);
        oTable.fnDraw();
    }

}


function generatePdfWithCharts(idButton){
    $("#"+idButton).click(function (e){
        captureCharts(e);
    });
}

function captureCharts(e){
    var allCharts = AmCharts.charts;
    allCharts.forEach(function(chart) {
        var tmp = new AmCharts.AmExport(chart);
            tmp.init();
            tmp.output({
                output: 'datastring',
                format: 'jpg',
                dpi:'30',
            },function(blob) {

            var image = new Image();
            image.src = blob;

            var formData = new FormData();
            formData.append("imageChart", image.src);
            formData.append("imageChartName", chart.div.id);

            urlExport= oConstantes.baseUrl + '/services/admin-technique/capture-chart';

            $.ajax(urlExport, {
                method: "POST",
                data : formData,
                processData: false,
                contentType: false,
                success: function (content) {
                },
                error: function () {
                }
            });
            e.preventDefault();
        });
    });

    pdf_url =  oConstantes.baseUrl + '/services/admin-technique/export-pdf-chart';
    window.open(pdf_url, '_blank');

}