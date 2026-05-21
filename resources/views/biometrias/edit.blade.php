<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div class="bg-gradient-to-r from-cyan-600 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                            <i class="bi bi-pencil-square text-2xl"></i>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold">
                                Editar Biometría Hemática
                            </h2>
                            <p class="text-cyan-100 text-sm">
                                Actualiza los resultados hematológicos del paciente
                            </p>
                        </div>
                    </div>

                    <a
                        href="{{ route('consultas.show', $consulta->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white text-cyan-700 font-medium hover:scale-105 transition"
                    >
                        <i class="bi bi-arrow-left-circle-fill"></i>
                        Volver a consulta
                    </a>
                </div>
            </div>

            <form
                action="{{ route('biometrias.update', $consulta->id) }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                {{-- DATOS DEL PACIENTE --}}
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
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->nombre }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Especie</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->mascota->especie }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Veterinario</p>
                            <p class="font-semibold text-gray-800">{{ $consulta->veterinario }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 mb-1">Fecha</p>
                            <p class="font-semibold text-gray-800">{{ now()->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- TABLA --}}
                <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                    <div class="px-6 pt-6 pb-4 flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <i class="bi bi-table text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Parámetros de biometría
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
                                @foreach ($parametros as $key => $item)
                                    @php
                                        $valor = $biometrias->firstWhere('parametro', $item['label']);
                                    @endphp

                                    <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $item['label'] }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <input
                                                type="text"
                                                name="biometria[{{ $key }}][resultado]"
                                                value="{{ $valor->resultado ?? '' }}"
                                                class="w-32 text-center rounded-full border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500"
                                            >

                                            <input
                                                type="hidden"
                                                name="biometria[{{ $key }}][parametro]"
                                                value="{{ $item['label'] }}"
                                            >

                                            <input
                                                type="hidden"
                                                name="biometria[{{ $key }}][referencia_perro]"
                                                value="{{ $item['perro'] }}"
                                            >

                                            <input
                                                type="hidden"
                                                name="biometria[{{ $key }}][referencia_gato]"
                                                value="{{ $item['gato'] }}"
                                            >
                                        </td>

                                        <td class="px-6 py-4 text-center text-gray-600">
                                            {{ $item['perro'] }}
                                        </td>

                                        <td class="px-6 py-4 text-center text-gray-600">
                                            {{ $item['gato'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- BOTONES --}}
                <div class="flex justify-end gap-3">
                    <a
                        href="{{ route('consultas.show', $consulta->id) }}"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 hover:scale-105 transition"
                    >
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-teal-600 text-white shadow-lg hover:bg-teal-700 hover:scale-105 transition-all duration-200"
                    >
                        <i class="bi bi-check2-circle"></i>
                        Guardar cambios
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>