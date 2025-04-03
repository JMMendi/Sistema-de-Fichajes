<div>
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                aspectRatio: 2,
                timeZone: "local",
                firstDay: 1,
            });
            calendar.setOption('locale', 'es');
            calendar.render();
        });
    </script>
    <div id='calendar'></div>
</div>
