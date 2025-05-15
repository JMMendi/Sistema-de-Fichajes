<div>
    <section>
        <x-button wire:click="$set('abrirModalFestividades', true)">Menú Festividades</x-button>
    </section>
    <x-dialog-modal wire:model="abrirModalFestividades" maxWidth="3xl">
        <x-slot name="title">
            Menú de Festividades
        </x-slot>
        <x-slot name="content">
            <article class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Día
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                Mes
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dias as $item)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                {{$item->nombre}}
                            </th>
                            <td class="px-6 py-4">
                                {{$item->dia}}
                            </td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                {{ucfirst(\Carbon\Carbon::parse("2025-".$item->mes."-1")->locale('es')->monthName)}}
                            </td>
                            <th scope="col" class="px-6 py-3">
                                <button wire:click="borrarFestivo({{$item->id}})">
                                    <i class="fas fa-trash text-gray-500 hover:text-gray-800"></i>
                                </button>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </article>
            @if($modalAdd)
            <article class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 p-3">
                    <div class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la festividad</label>
                        <input type="text" wire:model="cform.nombre" id="nombre" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="cform.nombre"/>
                    </div>
                    <div class="mb-5">
                        <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                        <input type="date" wire:model="cform.fecha" id="fecha" name="fecha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="cform.fecha"/>

                    </div>
                    <div class="flex items-center mb-4">
                        <input id="tipo" wire:model="cform.tipo" type="radio" name="tipo" value="Fijo" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="tipo" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            Fijo
                        </label>
                        <x-input-error for="cform.tipo"/>

                    </div>
                    <div class="flex items-center mb-4">
                        <input id="tipo" wire:model="cform.tipo" type="radio" name="tipo" value="Variable" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="tipo" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Variable
                        </label>
                        <x-input-error for="cform.tipo"/>

                    </div>

                    <button wire:click="store" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Añadir Festividad</button>
                    <button wire:click="cerrarFormulario" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Volver</button>

            </article>
            @endif
        </x-slot>
        <x-slot name="footer">
            <button type="button" wire:click="$set('modalAdd', true)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Añadir</button>
            <button type="button" wire:click="cerrarModal" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Volver</button>

        </x-slot>

    </x-dialog-modal>

</div>