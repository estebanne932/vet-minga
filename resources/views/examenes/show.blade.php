<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            @php
                $primero = $examenes->first();
            @endphp

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-cyan-600 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                            <i class="bi bi-droplet-half text-2xl"></i>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold">
                                Examen de Orina
                            </h2>
                            <p class="text-cyan-100 text-sm">
                                Resultados del paciente
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
                            href="{{ route('examenes.pdf', $consulta) }}"
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
                        <p class="font-semibold text-gray-800">{{ $primero->paciente ?? '—' }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Especie</p>
                        <p class="font-semibold text-gray-800">{{ $primero->especie ?? '—' }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Veterinario</p>
                        <p class="font-semibold text-gray-800">{{ $primero->veterinario ?? '—' }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Fecha</p>
                        <p class="font-semibold text-gray-800">
                            {{ $primero ? \Carbon\Carbon::parse($primero->fecha)->format('d/m/Y') : '—' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- DATOS MACROSCÓPICOS --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center">
                        <i class="bi bi-eyedropper text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Datos macroscópicos
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Color</p>
                        <p class="font-semibold text-gray-800">{{ $primero->color ?? '—' }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Aspecto</p>
                        <p class="font-semibold text-gray-800">{{ $primero->aspecto ?? '—' }}</p>
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
                            @forelse ($examenes as $item)
                                        @php
                                            $resultadoOriginal = strtoupper(trim($item->resultado ?? ''));
                                            $resultadoNumero = floatval(str_replace(',', '', $item->resultado));

                                            $esFelino = in_array(strtolower($item->especie), ['felino', 'gato', 'felina']);

                                            $referencia = $esFelino
                                                ? strtoupper(trim($item->referencia_gato ?? ''))
                                                : strtoupper(trim($item->referencia_perro ?? ''));

                                            // normalizar guiones
                                            $referenciaNormalizada = str_replace(['–', '—'], '-', $referencia);

                                            // primero intentar rango numérico
                                            preg_match('/([\d.,]+)\s*-\s*([\d.,]+)/', $referenciaNormalizada, $matches);

                                            if (!empty($matches)) {
                                                $min = floatval(str_replace(',', '', $matches[1]));
                                                $max = floatval(str_replace(',', '', $matches[2]));
                                                $dentroRango = ($resultadoNumero >= $min && $resultadoNumero <= $max);
                                            } else {
                                                // comparación textual
                                                $referenciaLimpia = trim($referenciaNormalizada);

                                                // casos especiales donde quieres permitir equivalencias
                                                $permitidos = [
                                                    'NEGATIVO' => ['NEGATIVO', 'NEG'],
                                                    'NEGATIVO - ESCASAS' => ['NEGATIVO', 'ESCASAS', 'NEGATIVO - ESCASAS'],
                                                ];

                                                if (isset($permitidos[$referenciaLimpia])) {
                                                    $dentroRango = in_array($resultadoOriginal, $permitidos[$referenciaLimpia], true);
                                                } else {
                                                    $dentroRango = $resultadoOriginal === $referenciaLimpia;
                                                }
                                            }
                                        @endphp

                                        <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                            <td class="px-6 py-4 font-medium text-gray-800">
                                                {{ $item->parametro }}
                                            </td>

                                            <td class="px-6 py-4 text-center font-semibold
                                                {{ $dentroRango ? 'text-green-600' : 'text-red-600' }}">
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
                                    @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        No hay resultados registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>