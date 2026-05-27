<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
         <div class="fixed bottom-6 right-6 z-50">
            <a
                href="{{ route('pacientes.create') }}"
                class="w-16 h-16 flex items-center justify-center rounded-full bg-teal-600 text-white shadow-xl hover:bg-teal-700 hover:scale-110 transition-all duration-200"
                title="Nuevo paciente"
            >
                <i class="bi bi-plus-lg text-2xl"></i>
            </a>
        </div>
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-search text-teal-600"></i>
                Buscar propietario
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Selecciona una mascota para continuar con el registro de esterilización.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                        <tr class="text-left">
                            <th class="px-6 py-4 font-semibold">Mascota</th>
                            <th class="px-6 py-4 font-semibold">Especie</th>
                            <th class="px-6 py-4 font-semibold">Edad</th>
                            <th class="px-6 py-4 font-semibold">Propietario</th>
                            <th class="px-6 py-4 font-semibold">Teléfono</th>
                            <th class="px-6 py-4 font-semibold text-center">Esterilizado</th>
                            <th class="px-6 py-4 font-semibold text-center">Acción</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($mascotas as $mascota)
                            <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($mascota->imagen)
                                            <img
                                                src="{{ asset('storage/' . $mascota->imagen) }}"
                                                class="w-12 h-12 rounded-full object-cover ring-2 ring-cyan-100"
                                                alt="Foto de {{ $mascota->nombre }}"
                                            >
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-gray-200 ring-2 ring-gray-100 flex items-center justify-center text-gray-400 font-semibold">
                                                {{ strtoupper(substr($mascota->nombre, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-semibold text-gray-800 leading-tight">
                                                {{ $mascota->nombre }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Paciente registrado
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $mascota->especie ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $mascota->edad ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $mascota->propietario->nombre ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                    {{ $mascota->propietario->telefono ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($mascota->esterilizado)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                            <i class="bi bi-check-circle-fill mr-1"></i>
                                            Sí
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">
                                            <i class="bi bi-dash-circle-fill mr-1"></i>
                                            No
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a
                                        href="{{ route('cirugias.form', $mascota) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 font-semibold text-xs shadow-sm transition-all duration-200 hover:bg-emerald-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                                        title="Seleccionar mascota"
                                    >
                                        <i class="bi bi-arrow-right-circle-fill text-sm"></i>
                                        Seleccionar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center">
                                    <div class="flex flex-col items-center gap-2 text-gray-500">
                                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="bi bi-emoji-frown text-2xl text-gray-400"></i>
                                        </div>
                                        <p class="font-medium">No hay pacientes registrados</p>
                                        <p class="text-sm">Todavía no existen mascotas para seleccionar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $mascotas->links() }}
        </div>
    </div>
</x-app-layout>