<x-plantilla.self>
    <h1 class="text-center text-xl mb-5">Informe</h1>
    <section class="flex flex-col justify-evenly sm:flex-row">
        <article class="sm:float-left mb-5">
            <div class="mb-5">
                <!-- Seleccionamos el trabajador -->
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                <select name="user_id" wire:model="user_id" id="user_id">
                    <option value="">Seleccione un Usuario</option>
                    @foreach($usuarios as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Ponemos una fecha de Inicio y una fecha de Salida -->
            <div class="mb-5">
                <label for="fechaInicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
                <input type="date" id="fechaInicio" wire:model="fechaInicio" name="fechaInicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="mb-5">
                <label for="fechaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin</label>
                <input type="date" id="fechaFin" wire:model="fechaFin" name="fechaFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <button wire:click="mesAnterior" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Mes Anterior</button>
            <!-- Al darle al botón, abriremos una ventana con el informe -->
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
                                    Día de la Semana
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Inicio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fin
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Horas del día
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $conteo = 0; ?>
                        @foreach($fechas as $fecha)

                            @foreach($fichas as $item)
                                @if($fecha == \Carbon\Carbon::parse($item->fechaInicio)->format('d-m-Y'))
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td class="px-6 py-4">
                                        {{\Carbon\Carbon::parse($item->fechaInicio)->format('l')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{\Carbon\Carbon::parse($item->fechaInicio)->format('d/m/Y (H:i:s)')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{\Carbon\Carbon::parse($item->fechaFin)->format('d/m/Y (H:i:s)')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(\Carbon\Carbon::parse($item->fechaInicio)->format('i') > \Carbon\Carbon::parse($item->fechaFin)->format('i'))
                                        {{($item->horas)+1}}
                                        @php
                                            $conteo += 1;
                                        @endphp
                                        @else
                                        {{$item->horas}}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->tipo}}
                                    </td>
                                </tr>


                                @elseif($fecha != \Carbon\Carbon::parse($item->fechaInicio)->format('d-m-Y') && $loop->first)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td @class([ 'px-6 py-4' , 'bg-red-200'=> \Carbon\Carbon::create($fecha)->isWeekend(),
                                        ])>
                                        {{\Carbon\Carbon::parse($fecha)->format('l')}}
                                    </td>
                                    <td @class([ 'px-6 py-4' , 'bg-red-200'=> \Carbon\Carbon::create($fecha)->isWeekend(),
                                        ])>
                                        {{\Carbon\Carbon::parse($fecha)->format('d/m/Y')}}
                                    </td>
                                    <td @class([ 'px-6 py-4' , 'bg-red-200'=> \Carbon\Carbon::create($fecha)->isWeekend(),
                                        ])>
                                        ------------
                                    </td>
                                    <td @class([ 'px-6 py-4' , 'bg-red-200'=> \Carbon\Carbon::create($fecha)->isWeekend(),
                                        ])>
                                        ------------
                                    </td>
                                    <td @class([ 'px-6 py-4' , 'bg-red-200'=> \Carbon\Carbon::create($fecha)->isWeekend(),
                                        ])>
                                        Vacio
                                    </td>
                                </tr>
                                    @continue
                                @endif

                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </article>
            <article>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-2 border-black">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">Horas al Mes</td>
                            <td class="px-6 py-4">Horas Totales</td>
                            <td class="px-6 py-4">Diferencia</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">{{$empleado->horasMes}}</td>
                            @foreach($fichaHoras as $item)
                            <td class="px-6 py-4">{{$item->horasTotales + $conteo}}</td>
                            <td class="px-6 py-4">{{($empleado->horasMes) - ($item->horasTotales)}}</td>
                            @endforeach

                        </tr>
                    </tbody>

                </table>
            </article>


            <div class="flex justify-center mt-5">
                <button type="button" wire:click="generarPdf" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Descargar en PDF</button>
            </div>
        </section>

        @endif
    </section>
</x-plantilla.self>