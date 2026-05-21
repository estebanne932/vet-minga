<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- HEADER PACIENTE --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-600 to-teal-600 px-6 py-5">
                    <div class="flex flex-col md:flex-row md:items-center gap-5">
                        <div class="shrink-0">
                            @if($paciente->imagen)
                                <img
                                    src="{{ asset('storage/' . $paciente->imagen) }}"
                                    class="w-28 h-28 md:w-32 md:h-32 object-cover rounded-2xl border-4 border-white/20 shadow-lg"
                                    alt="Foto de {{ $paciente->nombre }}"
                                >
                            @else
                                <div class="w-28 h-28 md:w-32 md:h-32 bg-white/20 rounded-2xl flex items-center justify-center text-white shadow-lg">
                                    <i class="bi bi-image text-4xl"></i>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 text-white">
                            <div class="flex flex-wrap items-center gap-3">
                                <h2 class="text-2xl md:text-3xl font-bold">
                                    {{ $paciente->nombre }}
                                </h2>

                                @if($paciente->esterilizado)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        <i class="bi bi-check-circle-fill mr-1"></i>
                                        Esterilizado
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold">
                                        <i class="bi bi-dash-circle-fill mr-1"></i>
                                        No esterilizado
                                    </span>
                                @endif
                            </div>

                            <p class="text-cyan-100 mt-1 text-sm md:text-base">
                                {{ $paciente->especie }} • {{ $paciente->raza }}
                            </p>

                            <p class="mt-2 text-sm text-cyan-100">
                                Edad: {{ $paciente->edad ?? '—' }} |
                                Peso: {{ $paciente->peso ?? '—' }}
                            </p>
                        </div>

                        @if($paciente->qr_code)
                            <div class="shrink-0 bg-white rounded-2xl p-3 shadow-md">
                                <img
                                    src="{{ asset('storage/' . $paciente->qr_code) }}"
                                    class="w-24 h-24 md:w-28 md:h-28"
                                    alt="QR del paciente"
                                >
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- PROPIETARIO --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center">
                        <i class="bi bi-person-fill text-lg"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Propietario
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Nombre</p>
                        <p class="font-semibold text-gray-800">{{ $paciente->propietario->nombre }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Teléfono</p>
                        <p class="font-semibold text-gray-800">{{ $paciente->propietario->telefono ?? '—' }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Correo</p>
                        <p class="font-semibold text-gray-800 break-all">{{ $paciente->propietario->correo ?? '—' }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-500 mb-1">Dirección</p>
                        <p class="font-semibold text-gray-800">{{ $paciente->propietario->direccion ?? '—' }}</p>
                    </div>
                </div>
            </div>

            {{-- HISTORIAL DE CONSULTAS --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="px-6 pt-6 pb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <i class="bi bi-clipboard2-pulse-fill text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Historial de consultas
                            </h3>
                            <p class="text-sm text-gray-500">
                                Seguimiento clínico del paciente
                            </p>
                        </div>
                    </div>

                    <a
                        href="{{ route('consultas.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-600 text-white shadow hover:bg-teal-700 hover:scale-105 transition"
                    >
                        <i class="bi bi-plus-circle-fill"></i>
                        Nueva consulta
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Fecha</th>
                                <th class="px-6 py-4 text-left font-semibold">Motivo</th>
                                <th class="px-6 py-4 text-left font-semibold">Veterinario</th>
                                <th class="px-6 py-4 text-center font-semibold">Estatus</th>
                                <th class="px-6 py-4 text-center font-semibold">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($paciente->consultas as $consulta)
                                <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $consulta->motivo }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $consulta->veterinario }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            @if($consulta->estatus === 'abierta') bg-green-100 text-green-700
                                            @elseif($consulta->estatus === 'en_proceso') bg-yellow-100 text-yellow-700
                                            @elseif($consulta->estatus === 'cerrada') bg-gray-200 text-gray-700
                                            @else bg-red-100 text-red-700
                                            @endif
                                        ">
                                            {{ ucfirst(str_replace('_',' ', $consulta->estatus)) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a
                                            href="{{ route('consultas.show', $consulta) }}"
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-teal-100 text-teal-600 shadow-sm transition-all duration-200 hover:bg-teal-600 hover:text-white hover:scale-105"
                                            title="Ver consulta"
                                        >
                                            <i class="bi bi-eye-fill text-base"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class="bi bi-clipboard-x text-2xl text-gray-400"></i>
                                            </div>
                                            <p class="font-medium">No hay consultas registradas</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ESTERILIZACIONES --}}
            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="px-6 pt-6 pb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-violet-100 text-violet-700 flex items-center justify-center">
                            <i class="bi bi-scissors text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Esterilizaciones
                            </h3>
                            <p class="text-sm text-gray-500">
                                Procedimientos registrados para este paciente
                            </p>
                        </div>
                    </div>

                    <a
                        href="{{ route('esterilizaciones.create', ['mascota_id' => $paciente->id]) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-600 text-white shadow hover:bg-teal-700 hover:scale-105 transition"
                    >
                        <i class="bi bi-plus-circle-fill"></i>
                        Registrar
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Fecha</th>
                                <th class="px-6 py-4 text-left font-semibold">Tipo</th>
                                <th class="px-6 py-4 text-left font-semibold">Veterinario</th>
                                <th class="px-6 py-4 text-center font-semibold">PDF</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($paciente->esterilizaciones as $e)
                                <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ \Carbon\Carbon::parse($e->fecha)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                                            {{ $e->tipo }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $e->veterinario }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($e->archivo_pdf)
                                            <a
                                                href="{{ asset('storage/' . $e->archivo_pdf) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-red-100 text-red-700 font-semibold text-xs shadow-sm transition-all duration-200 hover:bg-red-600 hover:text-white hover:scale-105"
                                                title="Ver PDF"
                                            >
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                PDF
                                            </a>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">
                                                Sin archivo
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-2">
                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class="bi bi-scissors text-2xl text-gray-400"></i>
                                            </div>
                                            <p class="font-medium">No hay esterilizaciones registradas</p>
                                        </div>
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