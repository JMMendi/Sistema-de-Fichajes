<x-plantilla.self>
    <h1 class="text-center text-xl mb-5">Informe Acumulado</h1>

    <section class="flex flex-col justify-evenly sm:flex-row">
        <article class="sm:float-left mb-5">
            <div class="mb-5">
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                <select name="user_id" wire:model="user_id" id="user_id">
                    <option value="">Seleccione un Usuario</option>
                    @foreach($usuarios as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label for="fechaInicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
                <input type="date" id="fechaInicio" wire:model="fechaInicio" name="fechaInicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="mb-5">
                <label for="fechaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin</label>
                <input type="date" id="fechaFin" wire:model="fechaFin" name="fechaFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <button type="submit" wire:click="recogerDatos" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Generar Informe</button>

        </article>


        @if($show)
        <section id="informe" class="flex flex-col sm:float-right top-5">
            <article>
                <h1 class="text-center">Informe de {{$empleado->nombre}}</h1>
                <h3 class="text-center">Datos del Empleado desde {{\Carbon\Carbon::parse($fechaInicio)->format('d/m/Y')}} hasta {{\Carbon\Carbon::parse($fechaFin)->format('d/m/Y')}}</h3>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-2 border-black p-2">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Mes
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acumulado Horas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Horas Contrato
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Diferencia
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fichas as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td class="px-6 py-4">
                                        {{\Carbon\Carbon::parse($item->fecha)->format('M Y')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->acumulado}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$empleado->horasMes}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->diferencia}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </article>

            <div class="flex justify-center mt-5">
                <button type="button" wire:click="generarPdf" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Descargar en PDF</button>
            </div>
        </section>

        @endif
    </section>
</x-plantilla.self>