<div>
    <x-button wire:click="$set('abrirFicharEntrada', true)">
        Entrada
    </x-button>
    <x-dialog-modal wire:model="abrirFicharEntrada">
        <x-slot name="title">
            Fichaje de Entrada
        </x-slot>
        <x-slot name="content">
            ¿Quiere hacer el fichaje de entrada?
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-5" wire:click="$js.mandarCoordenadas">Sí</x-button>
            <x-button wire:click="cerrarModal">No</x-button>
        </x-slot>
    </x-dialog-modal>

    @script
    <script defer>
        // 36.86564471581734, -2.4380703623223914 <- Latitud y Longitud según Google Maps

        // 36.8497134, -2.4486812 <- Latitud y Longitud según navigator.geolocation
        $js('mandarCoordenadas', () => {
            navigator.geolocation.getCurrentPosition(success, error, options);

        });

        function success(position) {
            $wire.latitude = position.coords.latitude
            $wire.longitude = position.coords.longitude

            console.log($wire.latitude + " - " + $wire.longitude);

            console.log(calcularDistanciaEntreDosCoordenadas($wire.latitude, $wire.longitude, 36.8497134, -2.4486812));

            if (calcularDistanciaEntreDosCoordenadas($wire.latitude, $wire.longitude, 36.8497134, -2.4486812) <= 100) {
                $wire.confirmarEntrada();
                Livewire.dispatchTo('inicio', 'entrada');
            } else {
                alert("Error, no está lo suficientemente cerca del lugar de trabajo para fichar la salida.");
            }
        }

        function error() {
            alert('Ha ocurrido un error. Inténtelo más tarde.');
        }

        const options = {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 27000,
        }

        const gradosARadianes = (grados) => {
            return grados * Math.PI / 180;
        };

        // Otra fórmula de Haversine
        const calcularDistanciaEntreDosCoordenadas = (lat1, lon1, lat2, lon2) => {
            // Convertir todas las coordenadas a radianes
            lat1 = gradosARadianes(lat1);
            lon1 = gradosARadianes(lon1);
            lat2 = gradosARadianes(lat2);
            lon2 = gradosARadianes(lon2);
            // Aplicar fórmula
            const RADIO_TIERRA_EN_KILOMETROS = 6371;
            let diferenciaEntreLongitudes = (lon2 - lon1);
            let diferenciaEntreLatitudes = (lat2 - lat1);
            let a = Math.pow(Math.sin(diferenciaEntreLatitudes / 2.0), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(diferenciaEntreLongitudes / 2.0), 2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return RADIO_TIERRA_EN_KILOMETROS * c;
        };
    </script>
    @endscript
</div>