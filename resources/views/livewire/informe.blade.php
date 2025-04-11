<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <style>
        h1,
        h3 {
            text-align: center;
        }

        table {
            border: 1px solid black;
            padding: 1%;
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 1%;
        }
    </style>

    <h1 class="text-center">Informe de {{$empleado->nombre}}</h1>
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
        <article>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">Horas al Mes</td>
                        <td class="px-6 py-4">Horas Totales</td>
                        <td class="px-6 py-4">Diferencia</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fichaHoras as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">{{$empleado->horasMes}}</td>
                        <td class="px-6 py-4">{{$item->horasTotales}}</td>
                        <td class="px-6 py-4">{{($empleado->horasMes) - ($item->horasTotales)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
    </div>
</body>


</html>