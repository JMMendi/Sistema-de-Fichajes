<div>
    <x-button wire:click="$set('abrirFicharEntrada', true)">
        Fichar Entrada
    </x-button>
    <x-dialog-modal wire:model="abrirFicharEntrada">
        <x-slot name="title">
            Fichaje de Entrada
        </x-slot>
        <x-slot name="content">
            ¿Quiere hacer el fichaje de entrada? Indique el motivo:
            <article class="border-2 border-indigo-500 rounded-md p-2">
                    <label for="motivos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivos de la Entrada</label>
                    @foreach($motivos as $item)
                    <div class="flex items-center mb-4">
                        <input id="{{$item}}" type="radio" name="{{$item}}" value="{{$item}}" wire:model="cform.motivoEntrada" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="{{$item}}" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{$item}}
                        </label>
                    </div>
                    @endforeach
            </article>
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
            $wire.latitude = position.coords.latitude;
            $wire.longitude = position.coords.longitude;
            
            $wire.confirmarEntrada();
            Livewire.dispatchTo('inicio', 'entrada');
        };
            // console.log($wire.latitude + " - " + $wire.longitude);

            // console.log(calcularDistanciaEntreDosCoordenadas($wire.latitude, $wire.longitude, 36.8497134, -2.4486812));

            // if (calcularDistanciaEntreDosCoordenadas($wire.latitude, $wire.longitude, 36.8497134, -2.4486812) <= 100) {
            //     $wire.confirmarEntrada();
            //     Livewire.dispatchTo('inicio', 'entrada');
            // } else {
            //     alert("Error, no está lo suficientemente cerca del lugar de trabajo para fichar la salida.");
            // }
        

        function error() {
            console.log('Ha ocurrido un error. Inténtelo más tarde.');
        };

        const options = {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 27000,
        };

    </script>
    @endscript
</div>