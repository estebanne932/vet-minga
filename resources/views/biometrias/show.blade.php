<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">
                Biometría Hemática
            </h2>

            <a
                href="{{ route('consultas.show', $consulta->id) }}"
                class="text-sm text-gray-600 hover:underline"
            >
                ← Volver a consulta
            </a>
            <a
                href="{{ route('biometrias.pdf', $consulta) }}"
                target="_blank"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm"
            >
                Descargar PDF
            </a>

        </div>

        {{-- Datos generales --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-3">Datos del paciente</h3>
            

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <p><strong>Mascota:</strong> {{ $biometrias->first()->paciente }}</p>
                <p><strong>Especie:</strong> {{ $biometrias->first()->especie }}</p>
                <p><strong>Veterinario:</strong> {{ $biometrias->first()->veterinario }}</p>
                <p><strong>Fecha:</strong>
                    {{ \Carbon\Carbon::parse($biometrias->first()->fecha)->format('d/m/Y') }}
                </p>
            </div>
        </div>

        {{-- Resultados --}}
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-2 text-left">Parámetro</th>
                        <th class="px-4 py-2 text-left">Resultado</th>
                        <th class="px-4 py-2 text-left">Referencia Perro</th>
                        <th class="px-4 py-2 text-left">Referencia Gato</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
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

                        <tr>
                            <td class="px-4 py-2 font-semibold">
                                {{ $item->parametro }}
                            </td>

                            <td class="px-4 py-2 font-semibold
                            {{ $dentroRango ? 'text-green-600' : 'text-red-600' }}
                            ">
                                {{ $item->resultado }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $item->referencia_perro }}
                            </td>

                            <td class="px-4 py-2">
                                {{ $item->referencia_gato }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
