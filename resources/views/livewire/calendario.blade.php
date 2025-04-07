<div>
    <script defer>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                aspectRatio: 2,
                timeZone: "local",
                firstDay: 1,
                dateClick: function(info) {
                alert('Este día es: ' + info.dateStr);
                },
            });
            calendar.setOption('locale', 'es');
            calendar.render();
        });

    </script>
    <div class="m-3 p-3" id='calendar'></div>
</div>
