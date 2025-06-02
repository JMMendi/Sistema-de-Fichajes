<x-plantilla.self>
    <section class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <article class="flex justify-center mt-3 mb-3">
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
        </article>
        <article>
        @livewire('calendario')
        </article>
    </section>
</x-plantilla.self>