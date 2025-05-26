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

    <section id="informe" class="flex flex-col sm:float-right top-5">
        <article>
            <h1 class="text-center">Informe de {{$empleado->nombre}} - {{$empleado->DNI}}</h1>

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