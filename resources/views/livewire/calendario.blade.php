<div>
    
    <script defer>
        
        function mostrarCalendario() {
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    aspectRatio: 2,
                    timeZone: "Europe/Madrid",
                    firstDay: 1,
                    titleFormat: {
                        month: 'long',
                        year: 'numeric',
                        day: 'numeric',
                        weekday: 'short',
                    },
                    businessHours: {
                        daysOfWeek: [1, 2, 3, 4, 5],

                    },
                    
                });
                calendar.setOption('locale', 'es');
                calendar.render();
            });
        }

        // function addEventos() {
        // var eventos = [];
        // $js('onEventos', () => {
        //     eventos.forEach(element => {
        //         calendar.addEvent({
        //             title: element.title,
        //             start: element.start
        //         })
        //     });
        // })
        // console.log(eventos);
        // }

        // addEventos();

        mostrarCalendario();

        // info.dateStr
    </script>

    <div class="m-3 p-3" id='calendar'></div>
</div>