/* global $j */

$j(document).ready(function () {

    /* -------------------------------------------- */
    var vuoto = {};
    var testate = {"0": "Scegli", "1": "La Stampa", "2": "Il Secolo XIX"};
    var edizione_1 = {"0": "Scegli", "1": "Quotidiana"};
    var edizione_2 = {"0": "Scegli", "1": "Pomeridiana"};
    var rubrica = {"0": "Scegli", "1": "Necrologie"};
    var defunto = {"0": "", "1": "Nino Bixio", "2": "Giuseppe Mazzini"};
    var gradopar = {"0": "", "1": "Amici", "2": "Colleghi", "3": "Coniuge", "4": "Conoscente"};
    var tipoannuncio = {"0": "Scegli", "1": "Adesione/Partecipazione", "2": "Anniversario", "3": "Famiglia/Annuncio", "4": "Ringraziamento/Trigesimo"};


    /* -------------------------------------------- */


    
    /*fillselect($j('#defunto'), defunto);*/

    $j("#tipoannunciosfondo1").change(function () {
        var sfondoid = $j('#tipoannunciosfondo1').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#ffffff")
        }
    })
    $j("#tipoannunciosfondo2").change(function () {
        var sfondoid = $j('#tipoannunciosfondo2').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#ffffff")
        }
    })
    $j("#tipoannunciosfondo3").change(function () {
        var sfondoid = $j('#tipoannunciosfondo3').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#ffffff")
        }
    })
    $j("#tipoannunciosfondo4").change(function () {
        var sfondoid = $j('#tipoannunciosfondo4').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#dddddd")
        }
    })
    $j("#tipoannunciosfondo5").change(function () {
        var sfondoid = $j('#tipoannunciosfondo5').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#ffffff")
        }
    })
    $j("#tipoannunciosfondo6").change(function () {
        var sfondoid = $j('#tipoannunciosfondo6').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#ffffff")
        }
    })
    $j("#tipoannunciosfondo7").change(function () {
        var sfondoid = $j('#tipoannunciosfondo7').is(":checked");
        //alert('suca');
        if (sfondoid == 1) {
            $j(".preview.finale").css("background-color", "#dddddd")
        }
    })
    
    
    var checkValidation = function(element) {        
        var tabelements = $j(element).find(':input');
        var passed = true;
        tabelements.each(function() {                           
            if(Validation.validate($(this.id)) === false) {
                passed = false;
            }
        });
        return passed;
    }
    
    $j('#rootwizard').bootstrapWizard({onNext: function (tab, navigation, index) {            
            
            if(checkValidation("#tab"+index) === false) {
                return false;
            }
            
            switch(index) {
                case 1:
                    var selectedDate = $j("#tab1 #date").val();
                    $j("#resumeWrapperValue\\:date").html(selectedDate);
                    
                    var selectedNewspaper = $j("#tab1 #testata").val();
                    var selectedNewspaperText = $j("#tab1 #testata").find(":selected").text();
                    $j("#resumeWrapperValue\\:newspaper").html(selectedNewspaperText);
                    
                    var selectedEdition = $j("#tab1 #edizione").val();
                    var selectedEditionText = $j("#tab1 #edizione").find(":selected").text();
                    $j("#resumeWrapperValue\\:newspaper_edition").html(selectedEditionText);
                    
                    var selectedSection = $j("#tab1 #rubrica").val();
                    var selectedSectionText = $j("#tab1 #rubrica").find(":selected").text();
                    $j("#resumeWrapperValue\\:newspaper_section").html(selectedSectionText);                    
                    
                    break;
                case 2:
                    
                    var selectedFirstName = $j("#tab2 #nomedef").val();
                    var selectedLastName = $j("#tab2 #cognomedef").val();
                    $j("#resumeWrapperValue\\:decuius").html(selectedFirstName + " " + selectedLastName);                    
                    
                    var selectedRelationship = $j("#tab2 #gradopar").val();
                    var selectedRelationshipText = $j("#tab2 #gradopar").find(":selected").text();
                    $j("#resumeWrapperValue\\:relationship").html(selectedRelationshipText);                    
                    break;
                case 3:
                    var selectedModel = $j("#tab3 #tipoannuncio").val();
                    var selectedModelText = $j("#tab3 #tipoannuncio").find(":selected").text();
                    $j("#resumeWrapperValue\\:model").html(selectedModelText);                    
                    
                    var selectedStyleText = $j(".style-image-item:checked").parent().last().text().trim();
                    $j("#resumeWrapperValue\\:model_style").html(selectedStyleText);   
                    
                    break;
                case 4:
                    break;
                case 5:
                    break;                
                    
            }
            
            if (index == 2) {
                // Make sure we entered the name
                /*if(!$j('#name').val()) {
                 alert('You must enter your name');
                 $j('#name').focus();
                 return false;
                 }*/
            }

            // Set the name for the next tab
            //	$j('#tab3').html('Hello, ' + $j('#name').val());

        }, onTabShow: function (tab, navigation, index) {
            var $jtotal = navigation.find('li').length;
            var $jcurrent = index + 1;
            var $jpercent = ($jcurrent / $jtotal) * 100;
            $j('#rootwizard .progress-bar').css({width: $jpercent + '%'});
        }});
    window.prettyPrint && prettyPrint()

    /* -------------------------------------------- */

    function fillselect(myselect, myjson) {

        myselect.find('option').remove();
        $j.each(myjson, function (key, value)
        {
            myselect.append('<option value=' + key + '>' + value + '</option>');
        });
    }
   
    function countparole(campo, prezzo) {
        if (!$j(campo).val()) {
            $j(campo + "-words").text(numwords);
            var numwords = 0;
        } else {
            var words = $j(campo).val().split(' ');
            var numwords = words.length;
        }
        var prepre = numwords * prezzo;
        $j(campo + "-par").css("display", "block");
        $j(campo + "-words").text(numwords);
        $j(campo + "-price").text(prepre.toFixed(2));
        //console.log("prepre: "+prepre);
        if (prepre == 0) {
            $j(campo + "-par").css("display", "none");
        }
        totale();
    }

    $j('#riepilogo').on('click', function () {
        //console.log('riepilogo click')
        //$j("#prezzototale").text('pippo');
        //totale();
    });

    function totale() {
        var totale = parseFloat($j("#citazione-price").text()) + parseFloat($j("#firmacitazione-price").text()) + parseFloat($j("#testoiniziale-price").text()) + parseFloat($j("#onorificienza-price").text()) + parseFloat($j("#nomecomdefunto-price").text()) + parseFloat($j("#vedovanza-price").text()) + parseFloat($j("#dianni-price").text()) + parseFloat($j("#testoinserzione-price").text()) + parseFloat($j("#listanomi-price").text()) + parseFloat($j("#luogodata-price").text());
        //console.log("totale: "+totale);
        $j("#prezzototale").text(totale.toFixed(2));
    }





});
