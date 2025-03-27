<x-plantilla.self>

    <div class="mb-5">
        <!-- Seleccionamos el trabajador -->
        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
        <select name="user_id" id="user_id">
            <option value="">Seleccione un Usuario</option>
            @foreach($usuarios as $item)
            <option value="{{$item->id}}">{{$item->nombre}}</option>
            @endforeach
        </select>
    </div>
        <!-- Ponemos una fecha de Inicio y una fecha de Salida -->
    <div class="mb-5">
        <label for="fechaInicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
        <input type="date" id="fechaInicio" name="fechaInicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <div class="mb-5">
        <label for="fechaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin</label>
        <input type="date" id="fechaFin" name="fechaFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
        <!-- Al darle al botón, abriremos una ventana con el informe -->
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

    
    <article>

    </article>

</x-plantilla.self>