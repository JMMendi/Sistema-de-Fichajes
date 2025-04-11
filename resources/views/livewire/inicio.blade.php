<x-plantilla.self>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center mt-3 mb-3">
                @if(count($fichaje) < 1)
                    <div class="mb-5 mt-5">
                        @livewire('fichar-entrada')
                    </div>
                @else
                    <div class="mb-5 mt-5">
                        @livewire('fichar-salida')
                    </div>
                @endif
            </div>
            @livewire('calendario')
        </div>
    </div>

</x-plantilla.self>