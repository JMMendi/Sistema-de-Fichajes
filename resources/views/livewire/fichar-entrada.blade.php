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
            <x-button class="mr-5" wire:click="confirmarEntrada">Sí</x-button>
            <x-button wire:click="cerrarModal">No</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
