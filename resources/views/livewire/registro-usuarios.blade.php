<x-plantilla.self>
    <x-button wire:click="$set('abrirModalCrear', true)">Crear Empleado</x-button>
    <x-dialog-modal wire:model="abrirModalCrear">
        <x-slot name="title">
            Registrar Empleado
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-center">
                <section class="w-2/3 flex flex-col shadow-xl border-2 border-black p-5 rounded-xl">
                    <article class="mb-5">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de Usuario</label>
                        <input type="text" id="username" wire:model="cform.username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="cform.username" />

                    </article>
                    <article class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" wire:model="cform.nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="cform.nombre" />

                    </article>
                    <article class="mb-5">
                        <label for="DNI" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                        <input type="text" id="DNI" name="DNI" wire:model="cform.DNI" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12345678A" required />
                        <x-input-error for="cform.DNI" />

                    </article>
                    <article class="mb-5">
                        <label for="horasMes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horas al Mes</label>
                        <input type="number" id="horasMes" wire:model="cform.horasMes" name="horasMes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="cform.horasMes" />

                    </article>
                    <article class="mb-5">
                        <label for="horasDia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horas al Día</label>
                        <input type="text" id="horasDia" wire:model="cform.horasDia" name="horasDia" data-tooltip-target="tooltip-right" data-tooltip-placement="right" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <div id="tooltip-right" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                            Formato Válido: X.X (P.E: 7.5)
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                        <x-input-error for="cform.horasDia" />
                    </article>
                    <article class="mb-5">
                        <label for="privilegios" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Privilegios</label>

                        <div class="flex">
                            <div>
                                <input id="Superior" wire:model="cform.superior" type="radio" name="privilegio" value="true" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                <label for="Superior" class="me-5">Superior</label>
                            </div>
                            <div>
                                <input id="admin" wire:model="cform.admin" checked type="radio" name="privilegio" value="true" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                <label for="admin">Administrador</label>
                            </div>
                            <div>
                                <input id="normal" checked type="radio" wire:model="cform.normal" name="privilegio" value="true" class="ms-5 w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                <label for="normal">Empleado</label>
                            </div>
                        </div>


                    </article>
                    <article class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" id="password" name="password" wire:model="cform.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <x-input-error for="cform.password" />

                    </article>
                </section>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="store" class="mr-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar Usuario</button>
            <button wire:click="cerrarModalCrear" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>
        </x-slot>
    </x-dialog-modal>



</x-plantilla.self>