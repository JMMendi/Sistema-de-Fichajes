<x-app-layout>

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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex mt-3 mb-3">
                    <div class="ml-5">
                        @livewire('fichaje')
                    </div>
                    @if(count($fichaje) < 1)
                    <div class="ml-5">
                        @livewire('fichar-entrada')
                    </div>
                    @else
                    <div class="ml-5">
                        @livewire('fichar-salida')
                    </div>
                    @endif
                </div>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</x-app-layout>