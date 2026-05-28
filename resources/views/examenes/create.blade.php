<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- ENCABEZADO --}}
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
                                Captura de resultados del paciente
                            </p>
                        </div>
                    </div>

                </div>
            </div>

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
                        <p class="text-gray-500 mb-1">Paciente</p>
                        <p class="font-semibold text-gray-800">
                            {{ $consulta->mascota->nombre }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Especie</p>
                        <p class="font-semibold text-gray-800">
                            {{ strtoupper($consulta->mascota->especie) }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Médico</p>
                        <p class="font-semibold text-gray-800">
                            {{ $consulta->veterinario }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Fecha</p>
                        <p class="font-semibold text-gray-800">
                            {{ now()->format('d/m/Y') }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('examenes.store', $consulta) }}">
                @csrf


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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- COLOR --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Color
                            </label>

                            <input
                                type="text"
                                name="color"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Ej. Amarillo"
                            >
                        </div>

                        {{-- ASPECTO --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Aspecto
                            </label>

                            <input
                                type="text"
                                name="aspecto"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Ej. Turbio"
                            >
                        </div>

                    </div>
                </div>
                <br>
                <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">

                    <div class="px-6 pt-6 pb-4 flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <i class="bi bi-table text-lg"></i>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            Parámetros
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">

                            <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold">
                                        Parámetro
                                    </th>

                                    <th class="px-6 py-4 text-center font-semibold">
                                        Resultado
                                    </th>

                                    <th class="px-6 py-4 text-center font-semibold">
                                        Perro
                                    </th>

                                    <th class="px-6 py-4 text-center font-semibold">
                                        Gato
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">

                                @foreach ($parametros as $key => $p)

                                    <tr class="hover:bg-cyan-50/60 transition-colors duration-200">

                                        <td class="px-6 py-4 text-gray-800 font-medium">
                                            {{ $p['label'] }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <input
                                                type="text"
                                                name="examen[{{ $key }}]"
                                                class="w-28 text-center rounded-full border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500"
                                            >
                                        </td>

                                        <td class="px-6 py-4 text-center text-gray-600">
                                            {{ $p['perro'] }}
                                        </td>

                                        <td class="px-6 py-4 text-center text-gray-600">
                                            {{ $p['gato'] }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- BOTÓN --}}
                <div class="mt-6 flex justify-end">

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-teal-600 text-white shadow-lg hover:bg-teal-700 hover:scale-105 transition-all duration-200"
                    >
                        <i class="bi bi-check2-circle"></i>
                        Guardar Examen
                    </button>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>