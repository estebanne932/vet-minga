<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">
                Consulta #{{ $consulta->expediente_num }}
            </h2>

            <a
                href="{{ route('consultas.index') }}"
                class="text-sm text-gray-600 hover:underline"
            >
                ← Volver
            </a>
        </div>

        {{-- Estatus --}}
        <div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold
                @if($consulta->estatus === 'abierta') bg-green-100 text-green-700
                @elseif($consulta->estatus === 'en_proceso') bg-yellow-100 text-yellow-700
                @elseif($consulta->estatus === 'cerrada') bg-gray-200 text-gray-700
                @else bg-red-100 text-red-700
                @endif
            ">
                {{ ucfirst(str_replace('_',' ', $consulta->estatus)) }}
            </span>
        </div>

        {{-- PROPIETARIO --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-3">Propietario</h3>

            <p><strong>Nombre:</strong> {{ $consulta->propietario->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $consulta->propietario->telefono }}</p>
            <p><strong>Correo:</strong> {{ $consulta->propietario->correo }}</p>
            <p><strong>Dirección:</strong> {{ $consulta->propietario->direccion }}</p>
        </div>

        {{-- MASCOTA --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-3">Mascota</h3>

            <div class="flex gap-6">
                @if($consulta->mascota->imagen)
                    <img
                        src="{{ asset('storage/' . $consulta->mascota->imagen) }}"
                        class="w-32 h-32 object-cover rounded border"
                    >
                @endif

                <div>
                    <p><strong>Nombre:</strong> {{ $consulta->mascota->nombre }}</p>
                    <p><strong>Especie:</strong> {{ $consulta->mascota->especie }}</p>
                    <p><strong>Raza:</strong> {{ $consulta->mascota->raza }}</p>
                    <p><strong>Edad:</strong> {{ $consulta->mascota->edad }}</p>
                    <p><strong>Peso:</strong> {{ $consulta->mascota->peso }}</p>
                    <p><strong>Esterilizada:</strong>
                        {{ $consulta->mascota->esterilizado ? 'Sí' : 'No' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- CONSULTA --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-3">Datos de la consulta</h3>

            <p><strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}
            </p>

            <p><strong>Veterinario:</strong> {{ $consulta->veterinario }}</p>

            <div class="mt-3">
                <strong>Motivo:</strong>
                <p class="mt-1 text-gray-700">{{ $consulta->motivo }}</p>
            </div>
        </div>

        {{-- EXAMEN FÍSICO --}}
        <h3 class="text-lg font-bold mt-8 mb-4">Examen físico</h3>

        <div class="bg-white rounded shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse ($consulta->examenFisico as $item)
                    <div class="border rounded p-3">
                        <p class="text-xs font-semibold text-gray-500 uppercase">
                            {{ $item->punto }}
                        </p>
                        <p class="text-gray-700 mt-1 text-sm">
                            {{ $item->respuesta ?: '—' }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm col-span-2">
                        No se registró examen físico descriptivo.
                    </p>
                @endforelse
            </div>
        </div>

        {{-- EXAMEN FÍSICO CHECK --}}
        <h3 class="text-lg font-bold mt-8 mb-4">
            Examen físico (checklist)
        </h3>

        <div class="bg-white rounded shadow p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($consulta->examenFisicoCheck as $item)
                    <div class="flex items-center justify-between border rounded p-3">
                        <span class="text-sm text-gray-700">
                            {{ $item->punto }}
                        </span>

                        @if ($item->respuesta)
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Sí
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                No
                            </span>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-sm col-span-3 text-center">
                        No se registró checklist de examen físico.
                    </p>
                @endforelse
            </div>
        </div>

        {{-- Quimica --}}
<h3 class="text-lg font-bold mt-8 mb-4">Quimica</h3>

<div class="bg-white rounded shadow p-6 flex items-center justify-between">

    <div>
        <p class="text-sm text-gray-700">
            Estado:
            @if($consulta->quimica->isNotEmpty())
                <span class="ml-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                    Registrada
                </span>
            @else
                <span class="ml-2 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                    No registrada
                </span>
            @endif
        </p>
    </div>

    <div class="flex gap-2">
        @if($consulta->quimica->isNotEmpty())

            {{-- VER --}}
            <a
                href="{{ route('quimica.show', $consulta->id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm"
            >
                Ver
            </a>

            {{-- EDITAR --}}
            <a
                href="{{ route('quimica.edit', $consulta->id) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm"
            >
                Editar
            </a>

            {{-- ELIMINAR --}}
            <form
                action="{{ route('quimica.destroy', $consulta->id) }}"
                method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar la biometría hemática?');"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm"
                >
                    Eliminar
                </button>
            </form>

        @else

            {{-- AGREGAR --}}
            <a
                href="{{ route('quimica.create', $consulta->id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm"
            >
                Agregar biometría
            </a>

        @endif
    </div>

</div>




        {{-- BIOMETRÍA HEMÁTICA --}}
<h3 class="text-lg font-bold mt-8 mb-4">Biometría hemática</h3>

<div class="bg-white rounded shadow p-6 flex items-center justify-between">

    <div>
        <p class="text-sm text-gray-700">
            Estado:
            @if($consulta->biometria->isNotEmpty())
                <span class="ml-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                    Registrada
                </span>
            @else
                <span class="ml-2 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                    No registrada
                </span>
            @endif
        </p>
    </div>

    <div class="flex gap-2">
        @if($consulta->biometria->isNotEmpty())

            {{-- VER --}}
            <a
                href="{{ route('biometrias.show', $consulta->id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm"
            >
                Ver
            </a>

            {{-- EDITAR --}}
            <a
                href="{{ route('biometrias.edit', $consulta->id) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm"
            >
                Editar
            </a>

            {{-- ELIMINAR --}}
            <form
                action="{{ route('biometrias.destroy', $consulta->id) }}"
                method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar la biometría hemática?');"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm"
                >
                    Eliminar
                </button>
            </form>

        @else

            {{-- AGREGAR --}}
            <a
                href="{{ route('biometrias.create', $consulta->id) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm"
            >
                Agregar biometría
            </a>

        @endif
    </div>

</div>


        {{-- DIAGNÓSTICO --}}
        <h3 class="text-lg font-bold mt-8 mb-4">Diagnóstico</h3>

        <div class="bg-white rounded shadow p-6 space-y-4">
            <div>
                <p class="text-sm font-semibold text-gray-700">
                    Diagnósticos diferenciales
                </p>
                <p class="text-gray-600 mt-1">
                    {{ $consulta->diagnostico->diagnosticos_diferenciales ?? '—' }}
                </p>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-700">
                    Diagnóstico definitivo
                </p>
                <p class="text-gray-600 mt-1">
                    {{ $consulta->diagnostico->diagnostico_definitivo ?? '—' }}
                </p>
            </div>
        </div>

        {{-- MEDICAMENTOS APLICADOS --}}
        <h3 class="text-lg font-bold mt-8 mb-4">Medicamentos aplicados</h3>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-2 text-left">Medicamento</th>
                        <th class="px-4 py-2 text-left">Dosis</th>
                        <th class="px-4 py-2 text-left">Frecuencia</th>
                        <th class="px-4 py-2 text-left">Periodo</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($consulta->medicamentosAplicados as $med)
                        <tr>
                            <td class="px-4 py-2">{{ $med->medicamento }}</td>
                            <td class="px-4 py-2">{{ $med->dosis ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $med->frecuencia ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $med->periodo ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                No se registraron medicamentos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>



        {{-- FIRMA --}}
        <div class="bg-white rounded shadow p-5">
            <h3 class="font-semibold mb-3">Firma del propietario</h3>

            @if($consulta->firma)
                <img
                    src="{{ asset('storage/' . $consulta->firma) }}"
                    class="border rounded max-w-md"
                >
            @else
                <p class="text-gray-500">Sin firma registrada</p>
            @endif
        </div>

    </div>
</x-app-layout>
