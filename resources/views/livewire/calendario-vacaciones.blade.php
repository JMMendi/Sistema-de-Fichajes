<div>
    <script defer>
        let vacaciones = <?php echo json_encode($eventos); ?>;
        console.log(vacaciones);
        function mostrarCalendario() {
            document.addEventListener('DOMContentLoaded', function() {

                var calendarEl = document.getElementById('calendario');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'multiMonthYear',
                    timeZone: 'Europe/Madrid',
                    firstDay: 1,
                    businessHours: {
                        daysOfWeek: [1, 2, 3, 4, 5],
                    },
                });

                vacaciones.forEach(element => {
                    calendar.addEvent(element);
                });
                calendar.setOption('locale', 'es');
                calendar.render();
            });
            // Hay que crear un método editar con los datos de las vacaciones mostradas en el calendario.
        }
        mostrarCalendario();
        // Si el usuario es administrador, mostrará TODAS las vacaciones, en grises y en naranja(por poner colores).
        // Si el usuario es empleado, mostrará SOLO las vacaciones de dicho usurio, en gris y en naranja.
        // Abrir modal para introducir datos de excedencias. Si eres empleado normal el confirmado estará en No.
        // El administrador podrá editar esas vacaciones SOLO el confirmado. El resto no (Y podrá eliminarlo)
    </script>
    <article class=" p-3 bg-gray-200" id='calendario'></article>

</div>