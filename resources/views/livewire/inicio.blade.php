<x-plantilla.self>
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
            @if(Auth::user()->admin)
                <div class="mb-5 ms-5 mt-5">
                    @livewire('festividades')
                </div>
            @endif
        </div>
    <div>
        @livewire('calendario')
    </div>
</x-plantilla.self>