<div>
    <x-button wire:click="$set('abrirFicharSalida', true)">
        Fichar Salida
    </x-button>
    <x-dialog-modal wire:model="abrirFicharSalida">
        <x-slot name="title">
            Fichaje de Salida
        </x-slot>
        <x-slot name="content">
            ¿Quiere hacer el fichaje de salida?
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-5" wire:click="$js.mandarCoordenadas">Sí</x-button>
            <x-button wire:click="cerrarModal">No</x-button>
        </x-slot>
    </x-dialog-modal>

    @script
    <script defer>
        $js('mandarCoordenadas', () => {
            navigator.geolocation.getCurrentPosition(success, error, options);

        });

        function success(position) {
            $wire.latitude = position.coords.latitude;
            $wire.longitude = position.coords.longitude;

            $wire.confirmarSalida();
            Livewire.dispatchTo('inicio', 'salida');

            // console.log($wire.latitude + " - " + $wire.longitude);

            // console.log(calcularDistanciaEntreDosCoordenadas($wire.latitude, $wire.longitude, 36.8497134, -2.4486812));

            // if (calcularDistanciaEntreDosCoordenadas($wire.latitude, $wire.longitude, 36.8497134, -2.4486812) <= 100) {
            //     $wire.confirmarSalida();
            //     Livewire.dispatchTo('inicio', 'salida');
            // } else {
            //     alert("Error, no está lo suficientemente cerca del lugar de trabajo para fichar la salida.");
            // }
        }

        function error() {
            alert('Ha ocurrido un error. Inténtelo más tarde.');
        }

        const options = {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 27000,
        }

    </script>
    @endscript
</div>