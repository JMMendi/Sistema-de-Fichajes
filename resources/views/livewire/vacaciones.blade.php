<div>
    <article class="flex justify-center mt-5 mb-5 ">
        <button class="mt-5 me-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" wire:click="abrirModal">
            Solicitud de Vacaciones
        </button>
        @if(Auth::user()->admin)
        <button wire:click="$set('showConfirmar', true)" class="mt-5 ms-5 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900" wire:click="abrirModal">
            Gestión de Vacaciones
        </button>
        @endif
    </article>
    <x-dialog-modal wire:model="show">
        <x-slot name="title">
            Solicitar Vacaciones
        </x-slot>
        <x-slot name="content">
            <!-- Mostramos un pequeño formulario -->
            <section class="mb-5">
                <label for="inicioVac" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
                <input type="date" name="inicioVac" wire:model="cform.inicioVac" id="inicioVac" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="cform.inicioVac" />
            </section>
            <section class="mb-5">
                <label for="finVac" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin</label>
                <input type="date" name="finVac" wire:model="cform.finVac" id="finVac" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="cform.finVac" />
            </section>
        </x-slot>
        <x-slot name="footer">

            <button wire:click="creaRegistro" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Solicitar Vacaciones
            </button>
            <button wire:click="cerrarModal" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Volver
            </button>

        </x-slot>
    </x-dialog-modal>
    @livewire('calendario-vacaciones')

    @if($showConfirmar)
    <x-dialog-modal wire:model="showConfirmar" maxWidth="3xl">
        <x-slot name="title">
            Gestión de Vacaciones
        </x-slot>
        <x-slot name="content">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre del Empleado
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Inicio de las Vacaciones
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fin de las Vacaciones
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Confirmación
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Borrar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacaciones as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->nombre}}
                            </th>
                            <td class="px-6 py-4">
                                {{\Carbon\Carbon::parse($item->inicioVac)->format('d/m/Y')}}

                            </td>
                            <td class="px-6 py-4">
                                {{\Carbon\Carbon::parse($item->finVac)->format('d/m/Y')}}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="actualizarVacaciones({{$item->id}})" @class([ 'p-2 rounded-xl' , 'bg-red-300'=> $item->confirmado == "No",
                                    'bg-blue-300' => $item->confirmado == "Si",
                                    'bg-gray-300' => $item->confirmado == "Pendiente",
                                    ])>
                                    @if($item->confirmado == "Si")
                                    Autorizado
                                    @elseif($item->confirmado == "No")
                                    Denegado
                                    @else
                                    {{$item->confirmado}}
                                    @endif
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="confirmarBorrado({{$item->id}})">
                                    <i class="fas fa-trash text-xl text-red-500 hover:text-red-700"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </x-slot>
        <x-slot name="footer">
            <button wire:click="$set('showConfirmar', false)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Volver</button>
        </x-slot>
    </x-dialog-modal>
    @endif
</div>