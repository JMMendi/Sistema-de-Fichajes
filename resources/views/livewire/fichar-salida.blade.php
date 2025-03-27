<div>
    <x-button wire:click="$set('abrirFicharSalida', true)">
        Salida
    </x-button>
    <x-dialog-modal wire:model="abrirFicharSalida">
        <x-slot name="title">
            Fichaje de Salida
        </x-slot>
        <x-slot name="content">
            ¿Quiere hacer el fichaje de salida?
        </x-slot>
        <x-slot name="footer">
            <x-button class="mr-5" wire:click="confirmarSalida">Sí</x-button>
            <x-button wire:click="cerrarModal">No</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
