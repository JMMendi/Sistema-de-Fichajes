<div>
    <h1>Informe de {{$empleado->nombre}}</h1>
    <h3>Datos del Empleado desde {{$fechaInicio}} hasta {{$fechaFin}}</h3>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                @foreach($fichas as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4">
                        {{$item->fechaInicio}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->fechaFin}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->horas}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->tipo}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>