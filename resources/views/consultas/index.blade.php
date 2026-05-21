<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="fixed bottom-6 right-6 z-50">
    <a
        href="{{ route('consultas.create') }}"
        class="w-16 h-16 flex items-center justify-center rounded-full bg-teal-600 text-white shadow-xl hover:bg-teal-700 hover:scale-110 transition-all duration-200"
        title="Nueva consulta"
    >
        <i class="bi bi-plus-lg text-2xl"></i>
    </a>
</div>

        {{-- 🩺 CONSULTAS --}}
        <div class="mt-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Consultas
                    </h3>
                    <p class="text-sm text-gray-500">
                        Registro clínico de pacientes atendidos
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white">
                            <tr class="text-left">
                                <th class="px-6 py-4 font-semibold">Fecha</th>
                                <th class="px-6 py-4 font-semibold">Propietario</th>
                                <th class="px-6 py-4 font-semibold">Mascota</th>
                                <th class="px-6 py-4 font-semibold">Motivo</th>
                                <th class="px-6 py-4 font-semibold text-center">Firma</th>
                                <th class="px-6 py-4 font-semibold text-center">Estatus</th>
                                <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($consultas as $consulta)
                                <tr class="hover:bg-cyan-50/60 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ \Carbon\Carbon::parse($consulta->fecha)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $consulta->propietario->nombre ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $consulta->mascota->nombre ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $consulta->motivo }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($consulta->firma)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                Firmada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">
                                                Sin firma
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <form method="POST" action="{{ route('consultas.estatus', $consulta) }}">
                                            @csrf
                                            @method('PATCH')

                                            <div class="inline-flex items-center gap-2">
                                                <span class="text-xs text-gray-500 hidden sm:inline">Estado</span>
                                                <select
                                                    name="estatus"
                                                    onchange="this.form.submit()"
                                                    class="text-xs font-semibold rounded-full px-3 py-2 border cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-400
                                                        {{ $colors[$consulta->estatus] ?? '' }}"
                                                >
                                                    <option value="abierta" @selected($consulta->estatus === 'abierta')>
                                                        Abierta
                                                    </option>
                                                    <option value="en_proceso" @selected($consulta->estatus === 'en_proceso')>
                                                        En proceso
                                                    </option>
                                                    <option value="cerrada" @selected($consulta->estatus === 'cerrada')>
                                                        Cerrada
                                                    </option>
                                                    <option value="cancelada" @selected($consulta->estatus === 'cancelada')>
                                                        Cancelada
                                                    </option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- VER --}}
                                            <a
                                                href="{{ route('consultas.show', $consulta) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-teal-100 text-teal-600 shadow-sm transition-all duration-200 hover:bg-teal-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-400"
                                                title="Ver consulta"
                                            >
                                                <i class="bi bi-eye-fill text-base"></i>
                                            </a>

                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route('consultas.edit', $consulta) }}"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 shadow-sm transition-all duration-200 hover:bg-blue-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                title="Editar consulta"
                                            >
                                                <i class="bi bi-pencil-square text-base"></i>
                                            </a>

                                            {{-- ELIMINAR --}}
                                            <form
                                                action="{{ route('consultas.destroy', $consulta) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar esta consulta? Esta acción no se puede deshacer.')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-600 shadow-sm transition-all duration-200 hover:bg-red-600 hover:text-white hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-400"
                                                    title="Eliminar consulta"
                                                >
                                                    <i class="bi bi-trash-fill text-base"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center gap-2 text-gray-500">
                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class="bi bi-clipboard2-pulse text-2xl text-gray-400"></i>
                                            </div>
                                            <p class="font-medium">No hay consultas registradas</p>
                                            <p class="text-sm">Agrega la primera consulta para comenzar el seguimiento clínico.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $consultas->links() }}
        </div>

    </div>
</x-app-layout>
