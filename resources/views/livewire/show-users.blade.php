<x-plantilla.self>
    <div class="relative overflow-x-auto">
        <section class="flex justify-between items-center">
            <div class="w-full">
                <input type="search" class="w-1/2" wire:model.live="buscar" placeholder="Buscar...">
            </div>
            <div class="w-full justify-items-end">
                @livewire('registro-usuarios')
            </div>
        </section>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                        Nombre Completo <i class="fas fa-sort ml-2"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('username')">
                        Usuario <i class="fas fa-sort ml-2"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DNI
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('horasMes')">
                        Horas al Mes <i class="fas fa-sort ml-2"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('horasDia')">
                        Horas al día <i class="fas fa-sort ml-2"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->nombre}}
                    </th>
                    <td class="px-6 py-4">
                        {{$item->username}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->DNI}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->horasMes}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->horasDia}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{$item->id}})">
                            <i class="fas fa-edit text-xl text-green-500 hover:text-green-700"></i>
                        </button>
                        <button wire:click="confirmarBorrarEmpleado({{$item->id}})">
                            <i class="fas fa-trash text-xl text-red-500 hover:text-red-700"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($uform->empleado != null)
    <x-dialog-modal wire:model="abrirModalEditar">
        <x-slot name="title">
            Editar Datos del Empleado
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-center">
                <section class="w-2/3 flex flex-col shadow-xl border-2 border-black p-5 rounded-xl">
                    <article class="mb-5">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de Usuario</label>
                        <input type="text" id="username" wire:model="uform.username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="uform.username" />

                    </article>
                    <article class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" wire:model="uform.nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="uform.nombre" />

                    </article>
                    <article class="mb-5">
                        <label for="DNI" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                        <input type="text" id="DNI" name="DNI" wire:model="uform.DNI" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12345678A" required />
                        <x-input-error for="uform.DNI" />

                    </article>
                    <article class="mb-5">
                        <label for="horasMes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horas al Mes</label>
                        <input type="number" id="horasMes" wire:model="uform.horasMes" name="horasMes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="uform.horasMes" />

                    </article>
                    <article class="mb-5">
                        <label for="horasDia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horas al Día</label>
                        <input type="text" id="horasDia" wire:model="uform.horasDia" name="horasDia" data-tooltip-target="tooltip-uright" data-tooltip-placement="right" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <div id="tooltip-uright" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                            Formato Válido: X.X (P.E: 7.5)
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <x-input-error for="uform.horasDia" />

                    </article>
                    <article class="mb-5">
                        <label for="privilegios" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Privilegios</label>
                        <div class="flex">
                            <div>
                                <input id="uSuperior" wire:model="uform.superior" type="radio" name="privilegio" value="true" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                <label for="uSuperior" class="me-5">Superior</label>
                            </div>
                            <div>
                                <input id="uAdmin" wire:model="uform.admin" type="radio" name="privilegio" value="true" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                <label for="uAdmin">Administrador</label>
                            </div>
                            <div>
                                @if(!$uform->admin && !$uform->superior)
                                <input id="uNormal" type="radio" wire:model="uform.normal" name="privilegio" value="true" class="ms-5 w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                @else
                                <input id="uNormal" type="radio" wire:model="uform.normal" name="privilegio" value="true" class="ms-5 w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                @endif
                                <label for="uNormal">Empleado</label>
                            </div>
                        </div>

                    </article>
                    <article class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" id="password" name="password" wire:model="uform.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="uform.password" />

                    </article>

                </section>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="update" class="mr-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar Cambios</button>
            <button wire:click="cerrarModal" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>

        </x-slot>

    </x-dialog-modal>

    @endif

</x-plantilla.self>