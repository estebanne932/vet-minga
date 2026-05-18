<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-6">

        {{-- 🐶 HEADER --}}
        <div class="bg-white shadow rounded p-6 flex gap-6 items-center">

            {{-- Imagen --}}
            @if($paciente->imagen)
                <img src="{{ asset('storage/' . $paciente->imagen) }}"
                     class="w-32 h-32 object-cover rounded">
            @else
                <div class="w-32 h-32 bg-gray-200 rounded"></div>
            @endif

            {{-- Info --}}
            <div class="flex-1">
                <h2 class="text-2xl font-bold">{{ $paciente->nombre }}</h2>

                <p class="text-gray-600">
                    {{ $paciente->especie }} • {{ $paciente->raza }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Edad: {{ $paciente->edad ?? '—' }} |
                    Peso: {{ $paciente->peso ?? '—' }}
                </p>

                <p class="mt-2">
                    @if($paciente->esterilizado)
                        <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                            Esterilizado
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">
                            No esterilizado
                        </span>
                    @endif
                </p>
            </div>

            {{-- QR --}}
            @if($paciente->qr_code)
                <div>
                    <img src="{{ asset('storage/' . $paciente->qr_code) }}"
                         class="w-24 h-24">
                </div>
            @endif

        </div>

        {{-- 🧍‍♂️ PROPIETARIO --}}
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-bold mb-3">Propietario</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Nombre:</span>
                    <p>{{ $paciente->propietario->nombre }}</p>
                </div>

                <div>
                    <span class="text-gray-500">Teléfono:</span>
                    <p>{{ $paciente->propietario->telefono ?? '—' }}</p>
                </div>

                <div>
                    <span class="text-gray-500">Correo:</span>
                    <p>{{ $paciente->propietario->correo ?? '—' }}</p>
                </div>

                <div>
                    <span class="text-gray-500">Dirección:</span>
                    <p>{{ $paciente->propietario->direccion ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- 📋 HISTORIAL DE CONSULTAS --}}
        <div class="bg-white shadow rounded p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold">Historial de consultas</h3>

                <a href="{{ route('consultas.create') }}"
                   class="text-sm text-teal-600 hover:underline">
                    + Nueva consulta
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200">

                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Motivo</th>
                            <th class="px-4 py-2">Veterinario</th>
                            <th class="px-4 py-2">Estatus</th>
                            <th class="px-4 py-2 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($paciente->consultas as $consulta)
                            <tr>

                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $consulta->motivo }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $consulta->veterinario }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ ucfirst($consulta->estatus) }}
                                </td>

                                <td class="px-4 py-2 text-right">
                                    <a href="{{ route('consultas.show', $consulta) }}"
                                       class="text-teal-600 hover:underline">
                                        Ver
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">
                                    No hay consultas registradas
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>


        {{-- ✂️ ESTERILIZACIONES --}}
        <div class="bg-white shadow rounded p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold">Esterilizaciones</h3>

                <a href="{{ route('esterilizaciones.create', ['mascota_id' => $paciente->id]) }}"
                class="text-sm text-teal-600 hover:underline">
                    + Registrar
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200">

                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Tipo</th>
                            <th class="px-4 py-2">Veterinario</th>
                            <th class="px-4 py-2">PDF</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($paciente->esterilizaciones as $e)
                            <tr>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($e->fecha)->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $e->tipo }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $e->veterinario }}
                                </td>

                                <td class="px-4 py-2">
                                    @if($e->archivo_pdf)
                                        <a href="{{ asset('storage/' . $e->archivo_pdf) }}"
                                        target="_blank"
                                        class="text-green-600 hover:underline">
                                            Ver PDF
                                        </a>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    No hay esterilizaciones registradas
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</x-app-layout>