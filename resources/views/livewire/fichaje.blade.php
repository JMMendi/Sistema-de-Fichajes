<div>
    <x-button wire:click="$set('abrirFichar', true)">
        Fichar
    </x-button>

    <x-dialog-modal wire:model="abrirFichar">
        <x-slot name="title">
            Ventana Fichaje
        </x-slot>
        <x-slot name="content">
            <section class="mb-5">
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                <select name="user_id" wire:model="cform.user_id" id="user_id">
                    <option value="">Seleccione un Usuario</option>
                    @foreach($usuarios as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                <x-input-error for="cform.user_id" />
            </section>
            <!-- Ponemos una hora de Inicio y una hora de Salida -->
            <section class="mb-5">
                <label for="fechaInicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
                <input type="datetime-local" name="fechaInicio" wire:model="cform.fechaInicio" id="fechaInicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="cform.fechaInicio" />

            </section>
            <section class="mb-5">
                <label for="fechaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin</label>
                <input type="datetime-local" name="fechaFin" wire:model="cform.fechaFin" id="fechaFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <x-input-error for="cform.fechaFin" />
            </section>
            <!-- Añadimos el motivo del fichaje de Entrada y el de Salida -->
            <section class="mb-5 flex justify-around">
                <article class="border-2 border-indigo-500 rounded-md p-2">
                    <label for="motivos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivos de la Entrada</label>
                    @foreach($motivos as $item)
                    <div class="flex items-center mb-4">
                        <input id="{{$item}}Entrada" type="radio" name="{{$item}}Entrada" id="{{$item}}Entrada" value="{{$item}}" wire:model="cform.motivoEntrada" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                        <label for="{{$item}}Entrada" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{$item}}
                        </label>
                    </div>
                    @endforeach
                    <x-input-error for="cform.motivoEntrada" />
                </article>
                <article class="border-2 border-red-500 rounded-md p-2">
                    <label for="motivos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Motivos de la Salida</label>
                    @foreach($motivos as $item)
                    <div class="flex items-center mb-4">
                        <input id="{{$item}}Salida" type="radio" name="{{$item}}Salida" id="{{$item}}Salida" value="{{$item}}" wire:model="cform.motivoSalida" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                        <label for="{{$item}}Salida" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{$item}}
                        </label>
                    </div>
                    @endforeach
                    <div class="flex items-center mb-4">
                        <input id="motivoSalida" type="radio" name="motivoSalida" id="motivoSalida" value="" wire:model="cform.motivoSalida" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                        <label for="no" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            Todavía no
                        </label>
                    </div>
                    <x-input-error for="cform.motivoSalida" />

                </article>


            </section>


        </x-slot>
        <x-slot name="footer">
            <!-- Al darle a enviar se registra el fichaje -->
            <button wire:click="store" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-3">Guardar</button>
            <button wire:click="cerrarFichar" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Volver</button>
        </x-slot>
    </x-dialog-modal>
</div>