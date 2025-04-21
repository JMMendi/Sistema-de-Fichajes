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
                    dateClick: function(info) {
                        Livewire.dispatch("comprobar", {
                            fechaInicio: info.dateStr
                        });
                    },
                });
                calendar.setOption('locale', 'es');
                calendar.render();
            });
        }
        mostrarCalendario();

        // info.dateStr
    </script>


    <div class="m-3 p-3" id='calendar'></div>
</div>