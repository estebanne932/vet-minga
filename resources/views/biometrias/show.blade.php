<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-cyan-600 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                            <i class="bi bi-activity text-2xl"></i>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold">
                                Biometría Hemática
                            </h2>
                            <p class="text-cyan-100 text-sm">
                                Resultados hematológicos del paciente
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a
                            href="{{ route('consultas.show', $consulta->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-cyan-700 font-medium hover:scale-105 transition"
                        >
                            <i class="bi bi-arrow-left-circle-fill"></i>
                            Volver a consulta
                        </a>

                        <a
                            href="{{ route('biometrias.pdf', $consulta) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-600 text-white font-medium shadow hover:bg-red-700 hover:scale-105 transition"
                        >
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            Descargar PDF
                        </a>
                    </div>
                </div>
            </div>

            {{-- DATOS GENERALES --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center">
                        <i class="bi bi-clipboard2-pulse-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Datos del paciente
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Mascota</p>
                        <p class="font-semibold text-gray-800">{{ $biometrias->first()->paciente }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Especie</p>
                        <p class="font-semibold text-gray-800">{{ $biometrias->first()->especie }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Veterinario</p>
                        <p class="font-semibold text-gray-800">{{ $biometrias->first()->veterinario }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Fecha</p>
                        <p class="font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($biometrias->first()->fecha)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- RESULTADOS --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="px-6 pt-6 pb-4 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <i class="bi bi-table text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Resultados
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Parámetro</th>
                                <th class="px-6 py-4 text-center font-semibold">Resultado</th>
                                <th class="px-6 py-4 text-center font-semibold">Referencia Perro</th>
                                <th class="px-6 py-4 text-center font-semibold">Referencia Gato</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach ($biometrias as $item)
                                @php
                                    // Resultado limpio
                                    $resultado = floatval(str_replace(',', '', $item->resultado));

                                    // Normalizamos especie
                                    $esFelino = strtolower($item->especie) === 'felino';

                                    // Elegimos referencia SEGÚN ESPECIE
                                    $referencia = $esFelino
                                        ? $item->referencia_gato
                                        : $item->referencia_perro;

                                    // Extraer mínimo y máximo del rango
                                    preg_match('/([\d.,]+)\s*–\s*([\d.,]+)/', $referencia, $matches);

                                    $min = isset($matches[1]) ? floatval(str_replace(',', '', $matches[1])) : null;
                                    $max = isset($matches[2]) ? floatval(str_replace(',', '', $matches[2])) : null;

                                    // Validación final
                                    $dentroRango = $min !== null && $max !== null
                                        ? ($resultado >= $min && $resultado <= $max)
                                        : true;
                                @endphp

                                <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $item->parametro }}
                                    </td>

                                    <td class="px-6 py-4 text-center font-semibold">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full
                                            {{ $dentroRango ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->resultado }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center text-gray-600">
                                        {{ $item->referencia_perro }}
                                    </td>

                                    <td class="px-6 py-4 text-center text-gray-600">
                                        {{ $item->referencia_gato }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>