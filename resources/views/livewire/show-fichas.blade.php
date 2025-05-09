<x-plantilla.self>
    <div class="relative overflow-x-auto">
        <section class="flex justify-between mb-5">
            <div class="w-full">
                <input type="search" class="w-1/3" wire:model.live="texto" placeholder="Buscar...">
            </div>
            <div class="mt-2">
                @livewire('fichaje')
            </div>
        </section>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                        Nombre <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('fechaInicio')">
                        Fecha - (Hora) Inicio <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('fechaFin')">
                        Fecha - (Hora) Fin <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('horas')">
                        Horas Diarias <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th scope="col" class="px-6 py-3" >
                        Coordenadas
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('tipo')">
                        Tipo <i class="fas fa-sort ml-1"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($fichas as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->nombre}}
                    </th>
                    <td class="px-6 py-4">
                        {{\Carbon\Carbon::parse($item->fechaInicio)->format('d/m/Y - (H:i:s)')}}
                    </td>
                    <td class="px-6 py-4">
                        {{\Carbon\Carbon::parse($item->fechaFin)->format('d/m/Y - (H:i:s)')}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->horas}}
                    </td>
                    <td class="px-6 py-4">
                        {{($item->latitud)}} / {{($item->longitud)}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->tipo}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{$item->fichaId}})">
                            <i class="fas fa-edit text-xl text-green-700"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{$fichas->links()}}
    </div>

    <!-- Ventana Modal Editar -->
    @isset($uform->ficha)
    <x-dialog-modal wire:model="abrirModalEditar">

        <x-slot name="title">
            Editar Fichaje
        </x-slot>

        <x-slot name="content">

            <section class="mb-5">
                <!-- Poner el nombre del trabajador cuya ficha se va a editar -->
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" disabled name="nombre" id="nombre" wire:model="uform.nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </section>

            <section class="mb-5">
                <label for="fechaInicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
                <input type="datetime-local" name="fechaInicio" wire:model="uform.fechaInicio" id="fechaInicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="uform.fechaInicio" />

            </section>
            <section class="mb-5">
                <label for="fechaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin</label>
                <input type="datetime-local" name="fechaFin" wire:model="uform.fechaFin" id="fechaFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="uform.fechaFin" />
            </section>

        </x-slot>

        <x-slot name="footer">
            <!-- Al darle a enviar se registra el fichaje -->
            <button wire:click="update" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-3">Editar</button>
            <button wire:click="cerrarModal" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>
        </x-slot>

    </x-dialog-modal>
    @endisset

</x-plantilla.self>