

/*<script>
function initMap() {
    var louvre = {lat: 48.860711, lng: 2.337640};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: louvre
    });
    var marker = new google.maps.Marker({
        position: louvre,
        map: map
    });
}
</script>*/

<!-- Gestion de l'ajout des tickets -->

$(function() {
        var $container = $('div#reservationbundle_command_tickets');
        var index = $container.find(':input').length;
        $('#add_category').click(function(e) {
            addCategory($container);
            e.preventDefault();
            return false;
        });

        if (index == 0) {
            addCategory($container);
        } else {
            $container.children('div').each(function() {
                addDeleteLink($(this));
            });
        }

        function addCategory($container) {
            var template = $container.attr('data-prototype')
                .replace(/__name__label__/g, '')
                .replace(/__name__/g,        index)
            ;
            var $prototype = $(template);
            if (!index == 0) {
                addDeleteLink($prototype);
            }

            $container.append($prototype);
            index++;
        }

        function addDeleteLink($prototype) {
            var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
            $prototype.append($deleteLink);
            $deleteLink.click(function(e) {
                $prototype.remove();
                e.preventDefault();
                return false;
            });
        }

<!-- Suppression du ticket journée après 14h -->
        document.getElementById('reservationbundle_command_type').addEventListener("focus", function(e){
            var date_user = document.getElementById('datepicker').value;
            var date_today = new Date().toLocaleDateString("fr-FR");
            console.log(date_today, date_user);
            if (date_user === date_today) {
                $('#reservationbundle_command_type option[value="1"]').hide();
            } else {
                $('#reservationbundle_command_type option[value="1"]').show();
            }
        });

<!-- Datepicker -->
        $.datepicker.regional['fr'] = {
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
            monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
            dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
            dayNamesMin: ['D','L','M','M','J','V','S'],
            weekHeader: 'Sem.',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['fr']);

        disableDays = function(date) {
            console.log(date);
            var dateDay = date.getDate();
            var month = date.getMonth();
            var day = date.getDay();
            if (day == 2 || day == 0) {
                return [false] ;
            }
            else if ((dateDay == 25 && month == 11) || (dateDay == 1 && month == 4) || (dateDay == 1 && month == 10))
            {
                return [false] ;
            }
            else {
                return [true] ;
            }
        }
        var dateToday = new Date();
        $('#datepicker').datepicker({
            minDate : dateToday,
            beforeShowDay: disableDays });
        $('#reservationbundle_ticket_user_birthday').datepicker({
            changeMonth: true,
            changeYear: true
        });


    });
