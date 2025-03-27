<x-plantilla.self>
    

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
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
                    {{$item->fechaInicio}}
                </td>
                <td class="px-6 py-4">
                    {{$item->fechaFin}}
                </td>
                <td class="px-6 py-4">
                    {{$item->horas}}
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
     

</x-plantilla.self>