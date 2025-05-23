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
                @foreach($fechas as $fecha)

                @foreach($fichas as $item)
                @if($fecha == \Carbon\Carbon::parse($item->fechaInicio)->format('d-m-Y'))

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4">
                        {{$item->fechaInicio->format('l')}}
                    </td>
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
        <section style="margin-top: 2%; display:flex; justify-content:space-between; width:100%;">
            <article style="border:1px solid black; float:left; padding-right:250px; padding-bottom:10%; flex-grow:1;">
                La Empresa
            </article>
            <article style="border:1px solid black; float:right; border-left-style:none; padding-left:300px; padding-bottom:10%; flex-grow:1;">
                {{$empleado->DNI}} - {{$empleado->nombre}}
            </article>
        </section>
    </div>
</body>


</html>